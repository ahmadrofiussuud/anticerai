<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Couple;
use Illuminate\Support\Str;
use Livewire\Component;
use Carbon\Carbon;

class PairingManager extends Component
{
    public $pairingCode = '';
    public $partnerCode = '';
    public $showCodeInput = false;

    public function generatePairingCode()
    {
        $user = auth()->user();
        
        // Generate unique 6-character code
        do {
            $code = strtoupper(Str::random(6));
        } while (User::where('pairing_code', $code)->exists());
        
        // Save code with 24-hour expiration
        $user->update([
            'pairing_code' => $code,
            'pairing_code_expires_at' => Carbon::now()->addHours(24),
        ]);
        
        $this->pairingCode = $code;
        session()->flash('success', 'Pairing code generated! Share this code with your partner.');
    }

    public function connectWithCode()
    {
        $this->validate([
            'partnerCode' => 'required|string|size:6',
        ]);

        // Find user with this pairing code
        $partner = User::where('pairing_code', strtoupper($this->partnerCode))
            ->where('pairing_code_expires_at', '>', Carbon::now())
            ->first();

        if (!$partner) {
            $this->addError('partnerCode', 'Invalid or expired pairing code.');
            return;
        }

        if ($partner->id === auth()->id()) {
            $this->addError('partnerCode', 'You cannot pair with yourself.');
            return;
        }

        if ($partner->couple_id) {
            $this->addError('partnerCode', 'This user is already paired with someone else.');
            return;
        }

        // Create couple
        $couple = Couple::create([
            'name' => auth()->user()->name . ' & ' . $partner->name,
        ]);

        // Assign couple_id to both users
        auth()->user()->update(['couple_id' => $couple->id]);
        $partner->update([
            'couple_id' => $couple->id,
            'pairing_code' => null,
            'pairing_code_expires_at' => null,
        ]);

        session()->flash('success', 'Successfully paired with ' . $partner->name . '!');
        return redirect()->route('home');
    }

    public function cancelPairingCode()
    {
        auth()->user()->update([
            'pairing_code' => null,
            'pairing_code_expires_at' => null,
        ]);
        
        $this->pairingCode = '';
        session()->flash('success', 'Pairing code cancelled.');
    }

    public function mount()
    {
        $user = auth()->user();
        
        // Check if user has active pairing code
        if ($user->pairing_code && $user->pairing_code_expires_at > Carbon::now()) {
            $this->pairingCode = $user->pairing_code;
        }
    }

    public function render()
    {
        return view('livewire.pairing-manager');
    }
}
