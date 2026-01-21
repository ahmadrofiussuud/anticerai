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
        'photo' => null
    ];

    public function mount()
    {
        // Sample memories
        $this->memories = [
            [
                'id' => 1,
                'title' => 'First Date at Cafe',
                'date' => '2016-01-20',
                'description' => 'Our first coffee date together. We talked for hours and didn\'t want it to end.',
                'photo' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&h=600&fit=crop',
                'tags' => ['date', 'coffee']
            ],
            [
                'id' => 2,
                'title' => 'Beach Sunset',
                'date' => '2016-03-15',
                'description' => 'Watching the most beautiful sunset at the beach. Perfect moment.',
                'photo' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&h=600&fit=crop',
                'tags' => ['vacation', 'beach']
            ],
            [
                'id' => 3,
                'title' => 'Cooking Together',
                'date' => '2016-05-10',
                'description' => 'First time cooking dinner together. It was messy but so much fun!',
                'photo' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop',
                'tags' => ['home', 'cooking']
            ],
            [
                'id' => 4,
                'title' => 'Mountain Hiking',
                'date' => '2016-07-22',
                'description' => 'Adventure to the mountain peak. The view was breathtaking!',
                'photo' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800&h=600&fit=crop',
                'tags' => ['adventure', 'nature']
            ],
            [
                'id' => 5,
                'title' => 'Rainy Day Cuddles',
                'date' => '2016-09-08',
                'description' => 'Stayed in all day, watched movies, and enjoyed each other\'s company.',
                'photo' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=800&h=600&fit=crop',
                'tags' => ['home', 'cozy']
            ],
            [
                'id' => 6,
                'title' => 'Anniversary Dinner',
                'date' => '2017-01-20',
                'description' => 'Celebrating one year together at our favorite restaurant.',
                'photo' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&h=600&fit=crop',
                'tags' => ['anniversary', 'date']
            ],
        ];
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
        $this->selectedMemory = collect($this->memories)->firstWhere('id', $memoryId);
    }

    public function closeMemory()
    {
        $this->selectedMemory = null;
    }

    public function nextMemory()
    {
        if ($this->selectedMemory) {
            $currentIndex = collect($this->memories)->search(fn($m) => $m['id'] === $this->selectedMemory['id']);
            $nextIndex = ($currentIndex + 1) % count($this->memories);
            $this->selectedMemory = $this->memories[$nextIndex];
        }
    }

    public function previousMemory()
    {
        if ($this->selectedMemory) {
            $currentIndex = collect($this->memories)->search(fn($m) => $m['id'] === $this->selectedMemory['id']);
            $prevIndex = ($currentIndex - 1 + count($this->memories)) % count($this->memories);
            $this->selectedMemory = $this->memories[$prevIndex];
        }
    }

    public function saveMemory()
    {
        // Validation and save logic here
        $this->showUploadForm = false;
        session()->flash('message', 'Memory saved successfully!');
    }

    public function getFilteredMemoriesProperty()
    {
        $filtered = collect($this->memories);

        // Search filter
        if ($this->searchQuery) {
            $filtered = $filtered->filter(function($memory) {
                return str_contains(strtolower($memory['title']), strtolower($this->searchQuery)) ||
                       str_contains(strtolower($memory['description']), strtolower($this->searchQuery));
            });
        }

        // Tag filter
        if ($this->filterTag) {
            $filtered = $filtered->filter(function($memory) {
                return in_array($this->filterTag, $memory['tags']);
            });
        }

        // Sorting
        if ($this->sortBy === 'date_desc') {
            $filtered = $filtered->sortByDesc('date');
        } elseif ($this->sortBy === 'date_asc') {
            $filtered = $filtered->sortBy('date');
        } elseif ($this->sortBy === 'title') {
            $filtered = $filtered->sortBy('title');
        }

        return $filtered->values()->all();
    }

    public function getAllTagsProperty()
    {
        return collect($this->memories)
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.nostalgia-engine');
    }
}
