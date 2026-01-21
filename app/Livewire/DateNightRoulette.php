<?php

namespace App\Livewire;

use Livewire\Component;

class DateNightRoulette extends Component
{
    public $isSpinning = false;
    public $selectedActivity = null;
    public $activities = [];

    public function mount()
    {
        $this->activities = [
            [
                'id' => 1,
                'title' => 'Romantic Dinner',
                'description' => 'Cook a special meal together at home',
                'icon' => '🍽️',
                'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low'
            ],
            [
                'id' => 2,
                'title' => 'Movie Night',
                'description' => 'Watch a movie with popcorn and cuddles',
                'icon' => '🎬',
                'image' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low'
            ],
            [
                'id' => 3,
                'title' => 'Sunset Walk',
                'description' => 'Take a romantic walk during sunset',
                'icon' => '🌅',
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Free'
            ],
            [
                'id' => 4,
                'title' => 'Coffee Date',
                'description' => 'Visit a cozy cafe and chat for hours',
                'icon' => '☕',
                'image' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Low'
            ],
            [
                'id' => 5,
                'title' => 'Game Night',
                'description' => 'Play board games or video games together',
                'icon' => '🎮',
                'image' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low'
            ],
            [
                'id' => 6,
                'title' => 'Picnic',
                'description' => 'Pack a basket and enjoy nature',
                'icon' => '🧺',
                'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Low'
            ],
            [
                'id' => 7,
                'title' => 'Spa Night',
                'description' => 'Pamper each other with home spa',
                'icon' => '💆',
                'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low'
            ],
            [
                'id' => 8,
                'title' => 'Adventure Trip',
                'description' => 'Explore a new place or hiking trail',
                'icon' => '🏔️',
                'image' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Medium'
            ],
        ];
    }

    public function spinWheel()
    {
        $this->isSpinning = true;
        $this->selectedActivity = null;

        // Simulate spinning delay
        $this->dispatch('start-spin');
    }

    public function selectActivity($activityId)
    {
        $this->selectedActivity = collect($this->activities)->firstWhere('id', $activityId);
        $this->isSpinning = false;
    }

    public function resetSelection()
    {
        $this->selectedActivity = null;
        $this->isSpinning = false;
    }

    public function render()
    {
        return view('livewire.date-night-roulette');
    }
}
