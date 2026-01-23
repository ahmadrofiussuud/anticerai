<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class NostalgiaEngine extends Component
{
    use WithFileUploads;

    public $memories = [];
    public $showUploadForm = false;
    public $viewMode = 'grid'; // 'grid' or 'timeline'
    public $selectedMemory = null;
    public $searchQuery = '';
    public $filterTag = '';
    public $sortBy = 'date_desc'; // 'date_desc', 'date_asc', 'title'
    
    public $newMemory = [
        'title' => '',
        'date' => '',
        'description' => '',
        'tags' => '', // comma separated string for input
    ];
    public $photo;

    public function mount()
    {
        // Initial load not strictly needed if we use computed property, 
        // but can be good to init defaults
    }

    public function toggleUploadForm()
    {
        $this->showUploadForm = !$this->showUploadForm;
    }

    public function toggleViewMode()
    {
        $this->viewMode = $this->viewMode === 'grid' ? 'timeline' : 'grid';
    }

    public function selectMemory($memoryId)
    {
        $this->selectedMemory = \App\Models\Memory::find($memoryId);
    }

    public function closeMemory()
    {
        $this->selectedMemory = null;
    }

    public function nextMemory()
    {
        if ($this->selectedMemory) {
            $memories = $this->filteredMemories;
            $currentIndex = $memories->search(fn($m) => $m->id === $this->selectedMemory->id);
            if ($currentIndex !== false) {
                $nextIndex = ($currentIndex + 1) % $memories->count();
                $this->selectedMemory = $memories[$nextIndex];
            }
        }
    }

    public function previousMemory()
    {
        if ($this->selectedMemory) {
            $memories = $this->filteredMemories;
            $currentIndex = $memories->search(fn($m) => $m->id === $this->selectedMemory->id);
            if ($currentIndex !== false) {
                $prevIndex = ($currentIndex - 1 + $memories->count()) % $memories->count();
                $this->selectedMemory = $memories[$prevIndex];
            }
        }
    }

    public function saveMemory()
    {
        $this->validate([
            'newMemory.title' => 'required|string|max:255',
            'newMemory.date' => 'required|date',
            'newMemory.description' => 'nullable|string',
            'photo' => 'required|image|max:10240', // 10MB max
            'newMemory.tags' => 'nullable|string',
        ]);

        $path = $this->photo->store('memories', 'public');

        // Convert tags string to array
        $tags = collect(explode(',', $this->newMemory['tags']))
            ->map(fn($t) => trim($t))
            ->filter()
            ->values()
            ->all();

        // Assuming user is coupled
        $couple = auth()->user()->couple;
        
        if ($couple) {
            $couple->memories()->create([
                'title' => $this->newMemory['title'],
                'memory_date' => $this->newMemory['date'],
                'description' => $this->newMemory['description'],
                'image_path' => '/storage/' . $path,
                'tags' => $tags,
            ]);

            session()->flash('message', 'Memory saved successfully!');
        } else {
            session()->flash('error', 'You need to be coupled to save memories.');
        }

        $this->reset(['newMemory', 'photo', 'showUploadForm']);
    }

    public function getFilteredMemoriesProperty()
    {
        $query = \App\Models\Memory::query();

        // Filter by couple
        if (auth()->user()->couple_id) {
            $query->where('couple_id', auth()->user()->couple_id);
        } else {
            return collect([]); // Return empty if not coupled
        }

        // Search filter
        if ($this->searchQuery) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('description', 'like', '%' . $this->searchQuery . '%');
            });
        }

        // Tag filter (JSON search)
        if ($this->filterTag) {
            $query->whereJsonContains('tags', $this->filterTag);
        }

        // Sorting
        if ($this->sortBy === 'date_desc') {
            $query->orderBy('memory_date', 'desc');
        } elseif ($this->sortBy === 'date_asc') {
            $query->orderBy('memory_date', 'asc');
        } elseif ($this->sortBy === 'title') {
            $query->orderBy('title', 'asc');
        }

        return $query->get();
    }

    public function getAllTagsProperty()
    {
        if (!auth()->user()->couple_id) return [];

        // This might be heavy if lots of memories, but fine for now
        $tags = \App\Models\Memory::where('couple_id', auth()->user()->couple_id)
            ->get()
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->sort()
            ->values()
            ->all();
            
        return $tags;
    }

    public function render()
    {
        return view('livewire.nostalgia-engine');
    }
}
