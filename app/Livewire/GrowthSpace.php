<?php

namespace App\Livewire;

use Livewire\Component;

class GrowthSpace extends Component
{
    public $articles = [];
    public $videos = [];
    public $selectedArticle = null;

    public function mount()
    {
        $this->articles = \App\Models\GrowthMaterial::where('type', 'article')->get();
        $this->videos = \App\Models\GrowthMaterial::where('type', 'video')->get();
    }

    public function selectArticle($articleId)
    {
        $this->selectedArticle = \App\Models\GrowthMaterial::find($articleId);
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
