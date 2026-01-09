<?php

namespace App\Livewire;

use App\Services\CoupleService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class PairingManager extends Component
{
    public $pairingCode = '';
    public $generatedCode = null;

    public function generate(CoupleService $service)
    {
        try {
            $couple = $service->generatePairingCode(auth()->user());
            $this->generatedCode = $couple->pairing_code;
            
            // Refresh user to get the new couple_id
            auth()->user()->refresh();
            
            // Dispatch event or notify?
            session()->flash('success', 'Pairing code generated successfully!');
        } catch (ValidationException $e) {
            $this->addError('generate', $e->getMessage());
        }
    }

    public function connect(CoupleService $service)
    {
        $this->validate([
            'pairingCode' => 'required|string|size:6',
        ]);

        try {
            $service->pairUsers(auth()->user(), $this->pairingCode);
            
            auth()->user()->refresh();
            
            session()->flash('success', 'Details updated successfully! You are now paired.');
            
            // Redirect to dashboard to show full view?
            $this->redirect(route('dashboard'), navigate: true);
        } catch (ValidationException $e) {
            $this->addError('pairingCode', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pairing-manager');
    }
}
