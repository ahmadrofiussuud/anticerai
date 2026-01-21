<?php

namespace App\Livewire;

use Livewire\Component;

class GrowthSpace extends Component
{
    public $articles = [];
    public $selectedArticle = null;

    public function mount()
    {
        $this->articles = [
            [
                'id' => 1,
                'title' => '5 ways to understand your partner by listening',
                'subtitle' => 'Solusi ringan, hubungan berkualitas.',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop',
                'content' => 'Active listening is one of the most powerful tools in building a strong relationship...'
            ],
            [
                'id' => 2,
                'title' => 'How to prevent conflict in couples',
                'subtitle' => 'Solusi ringan, hubungan berkualitas.',
                'image' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=200&h=200&fit=crop',
                'content' => 'Understanding triggers and communication patterns can help prevent conflicts...'
            ],
            [
                'id' => 3,
                'title' => 'Building family resilience',
                'subtitle' => 'Solusi ringan, hubungan berkualitas.',
                'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=200&h=200&fit=crop',
                'content' => 'Family resilience is built through shared experiences and mutual support...'
            ],
            [
                'id' => 4,
                'title' => '10 good habits for couples every day',
                'subtitle' => 'Solusi ringan, hubungan berkualitas.',
                'image' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=200&h=200&fit=crop',
                'content' => 'Small daily habits can make a big difference in relationship quality...'
            ],
        ];
    }

    public function selectArticle($articleId)
    {
        $this->selectedArticle = collect($this->articles)->firstWhere('id', $articleId);
    }

    public function closeArticle()
    {
        $this->selectedArticle = null;
    }

    public function render()
    {
        return view('livewire.growth-space');
    }
}
