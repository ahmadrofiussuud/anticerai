<?php

namespace App\Livewire;

use App\Models\Insight;
use Livewire\Component;

class PartnershipPlaybook extends Component
{
    public $insight;
    public $isSaved = false;
    
    // Amora State
    public $amoraMode = null; // 'INTERPRETER', 'SPARK', or null
    public $userComplaint = '';
    public $partnerContextInput = '';
    public $amoraResponse = null;
    public $isLoading = false;

    public function mount()
    {
        $this->loadInsight();
    }

    public function loadInsight()
    {
        $user = auth()->user();
        $couple = $user->couple;
        
        // Default to random
        $context = 'random';

        if ($couple) {
            // Get partner ID
            $partnerId = ($couple->husband_id === $user->id) ? $couple->wife_id : $couple->husband_id;
            
            if ($partnerId) {
                // Check partner's latest energy log (within last 24h)
                $partnerLog = \App\Models\EnergyLog::where('user_id', $partnerId)
                    ->where('created_at', '>=', now()->subHours(24))
                    ->latest()
                    ->first();

                if ($partnerLog && $partnerLog->energy_level <= 2) {
                    $context = 'low_energy';
                }
            }
        }

        // Try to get insight by context, fallback to random if none found for context
        $this->insight = Insight::where('trigger_context', $context)->inRandomOrder()->first() 
            ?? Insight::inRandomOrder()->first();

        $this->checkIfSaved();
    }

    public function checkIfSaved()
    {
        if ($this->insight) {
            $this->isSaved = auth()->user()->savedInsights()->where('insight_id', $this->insight->id)->exists();
        }
    }

    public function toggleSave()
    {
        if (!$this->insight) return;

        $user = auth()->user();
        
        if ($this->isSaved) {
            $user->savedInsights()->detach($this->insight->id);
            $this->isSaved = false;
        } else {
            $user->savedInsights()->attach($this->insight->id);
            $this->isSaved = true;
        }
    }

    public function setAmoraMode($mode)
    {
        $this->amoraMode = $mode;
        $this->amoraResponse = null;
        $this->userComplaint = '';
        $this->partnerContextInput = '';
    }

    public function askAmora(\App\Services\AmoraService $amoraService)
    {
        $this->isLoading = true;
        $this->amoraResponse = null;

        $user = auth()->user();
        $couple = $user->couple;
        $partnerData = [];

        if ($couple) {
            $partnerId = ($couple->husband_id === $user->id) ? $couple->wife_id : $couple->husband_id;
            if ($partnerId) {
                $partner = \App\Models\User::find($partnerId);
                if ($partner) {
                    $partnerData['love_language'] = $partner->love_language ?? 'Unknown';
                    $partnerData['favorites'] = $partner->favorites ?? 'Unknown';
                }

                 $partnerLog = \App\Models\EnergyLog::where('user_id', $partnerId)
                    ->where('created_at', '>=', now()->subHours(24))
                    ->latest()
                    ->first();
                
                if ($partnerLog) {
                    $partnerData['energy_level'] = $partnerLog->energy_level;
                    $partnerData['last_note'] = $partnerLog->note;
                }
            }
        }

        $inputData = [
            'partner_context' => $partnerData,
            'user' => [
                'name' => $user->name,
            ]
        ];

        if ($this->amoraMode === 'INTERPRETER') {
            $inputData['user_complaint'] = $this->userComplaint;
            $inputData['additional_context'] = $this->partnerContextInput;
        } elseif ($this->amoraMode === 'SPARK') {
            $inputData['request'] = 'Generate a daily spark';
        }

        $this->amoraResponse = $amoraService->generateContent($this->amoraMode, $inputData);
        
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.partnership-playbook');
    }
}
