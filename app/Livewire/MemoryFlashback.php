<?php

namespace App\Livewire;

use App\Models\Memory;
use Livewire\Component;
use Livewire\WithFileUploads; // If we add image upload later

class MemoryFlashback extends Component
{
    public $title = '';
    public $description = '';
    public $date = '';
    public $showForm = false;
    
    public $randomMemory;

    public function mount()
    {
        $this->loadRandomMemory();
    }

    public function loadRandomMemory()
    {
        if (auth()->user()->couple) {
            $this->randomMemory = auth()->user()->couple->memories()->inRandomOrder()->first();
        }
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        if (auth()->user()->couple) {
            auth()->user()->couple->memories()->create([
                'title' => $this->title,
                'description' => $this->description,
                'memory_date' => $this->date,
            ]);

            $this->reset(['title', 'description', 'date', 'showForm']);
            session()->flash('memory-status', 'Memory saved successfully!');
            
            // Reload random memory to potentially show the new one? Or keep the old one?
            // Let's keep the old one for stability, or user can refresh.
        }
    }

    public function render()
    {
        return view('livewire.memory-flashback');
    }
}
