<?php

namespace App\Livewire;

use Livewire\Component;

class DateNightRoulette extends Component
{
    public $isSpinning = false;
    public $selectedActivity = null;
    public $activities = [];
    
    // Preferences
    public $mood = 'Relaxed';
    public $budget = 'Low';
    public $atmosphere = 'Romantis'; // Added atmosphere
    public $location = 'Indoor'; // Added location

    public function mount()
    {
        // Fallback activities
        $this->activities = [
            [
                'id' => 1,
                'title' => 'Makan Malam Romantis',
                'description' => 'Masak makanan spesial bersama di rumah dengan cahaya lilin.',
                'icon' => '🍽️',
                'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low',
                'atmospheres' => ['Romantis', 'Ngobrol Santai']
            ],
            [
                'id' => 2,
                'title' => 'Piknik di Taman',
                'description' => 'Nikmati udara segar dengan membawa bekal favorit ke taman kota.',
                'icon' => '🧺',
                'image' => 'https://images.unsplash.com/photo-1551524559-8af4e6624178?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Low',
                'atmospheres' => ['Romantis', 'Keluarga', 'Ngobrol Santai']
            ],
            [
                'id' => 3,
                'title' => 'Nonton Film di Rumah',
                'description' => 'Marathon film favorit dengan popcorn dan selimut hangat.',
                'icon' => '🎬',
                'image' => 'https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low',
                'atmospheres' => ['Romantis', 'Keluarga']
            ],
            [
                'id' => 4,
                'title' => 'Kelas Memasak Bersama',
                'description' => 'Ikuti kelas memasak atau coba resep baru bersama di dapur.',
                'icon' => '👨‍🍳',
                'image' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Medium',
                'atmospheres' => ['Ngobrol Santai', 'Romantis']
            ],
            [
                'id' => 5,
                'title' => 'Hiking & Sunrise',
                'description' => 'Mendaki gunung untuk menyaksikan matahari terbit bersama.',
                'icon' => '⛰️',
                'image' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Low',
                'atmospheres' => ['Petualangan', 'Romantis']
            ],
            [
                'id' => 6,
                'title' => 'Spa Day at Home',
                'description' => 'Manjakan diri dengan spa treatment di rumah.',
                'icon' => '💆',
                'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Medium',
                'atmospheres' => ['Romantis', 'Hemat']
            ],
            [
                'id' => 7,
                'title' => 'Kunjungan Museum',
                'description' => 'Jelajahi seni dan budaya di museum atau galeri lokal.',
                'icon' => '🎨',
                'image' => 'https://images.unsplash.com/photo-1554907984-15263bfd63bd?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low',
                'atmospheres' => ['Ngobrol Santai', 'Keluarga']
            ],
            [
                'id' => 8,
                'title' => 'Beach Sunset',
                'description' => 'Saksikan sunset romantis di pantai sambil jalan-jalan.',
                'icon' => '🏖️',
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Low',
                'atmospheres' => ['Romantis', 'Ngobrol Santai']
            ],
            [
                'id' => 9,
                'title' => 'Fine Dining',
                'description' => 'Rayakan malam istimewa di restoran mewah favorit.',
                'icon' => '🥂',
                'image' => 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'High',
                'atmospheres' => ['Romantis']
            ],
            [
                'id' => 10,
                'title' => 'Game Night',
                'description' => 'Malam seru dengan board games dan snacks favorit.',
                'icon' => '🎮',
                'image' => 'https://images.unsplash.com/photo-1610890716171-6b1bb98ffd09?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'Low',
                'atmospheres' => ['Keluarga', 'Ngobrol Santai', 'Hemat']
            ],
            [
                'id' => 11,
                'title' => 'Cycling Adventure',
                'description' => 'Jelajahi kota atau countryside dengan sepeda bersama.',
                'icon' => '🚴',
                'image' => 'https://images.unsplash.com/photo-1511994477422-b69e44bd4ea9?w=400&h=300&fit=crop',
                'category' => 'Outdoor',
                'budget' => 'Low',
                'atmospheres' => ['Petualangan', 'Hemat']
            ],
            [
                'id' => 12,
                'title' => 'Concert atau Live Music',
                'description' => 'Nikmati musik live dari artis atau band favorit.',
                'icon' => '🎵',
                'image' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=400&h=300&fit=crop',
                'category' => 'Indoor',
                'budget' => 'High',
                'atmospheres' => ['Petualangan', 'Romantis']
            ],
        ];

    }

    public function getFilteredActivitiesProperty()
    {
        return collect($this->activities)->filter(function ($activity) {
            // Filter by Location
            if ($this->location && $this->location !== $activity['category']) {
                return false;
            }

            // Filter by Budget (Optional: strict or loose?) 
            // Let's make it strict for now as per user input
            if ($this->budget && $this->budget !== $activity['budget']) {
                // Allow Low budget to show up in Medium searches check? No, user wants TEPAT.
                return false;
            }

            // Filter by Atmosphere
            if ($this->atmosphere && !in_array($this->atmosphere, $activity['atmospheres'])) {
                return false;
            }

            return true;
        })->values()->all();
    }

    public function getRecommendation(\App\Services\AmoraService $amora)
    {
        $this->isSpinning = true;
        $this->selectedActivity = null;
        
        try {
            $idea = $amora->generateDateIdea([
                'mood' => $this->mood,
                'budget' => $this->budget,
                'location' => $this->location,
                'atmosphere' => $this->atmosphere,
            ]);

            if ($idea) {
                $this->selectedActivity = [
                    'title' => $idea['title'],
                    'description' => $idea['description'],
                    'image' => $this->getActivityImage($idea['category']),
                    'category' => $idea['category'],
                    'budget' => $idea['budget'],
                    'id' => 999,
                    'icon' => $idea['icon'] ?? '✨',
                    'tips' => $idea['tips'] ?? '',
                ];
            } else {
                $this->selectedActivity = collect($this->activities)->random();
            }
        } catch (\Exception $e) {
             $this->selectedActivity = collect($this->activities)->random();
        }

        $this->isSpinning = false;
    }

    protected function getActivityImage($category)
    {
        if ($category === 'Outdoor') {
            return 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=80';
        }
        return 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=500&q=80';
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
