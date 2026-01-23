<?php

namespace App\Livewire;

use Livewire\Component;

class PartnerCoupling extends Component
{
    public $partnerCode;

    public function connect()
    {
        $this->validate(['partnerCode' => 'required|string|size:6']);

        $user = auth()->user();

        // 1. Check if trying to pair with self
        if ($user->pairing_code === $this->partnerCode) {
            $this->addError('partnerCode', 'You cannot pair with yourself.');
            return;
        }

        // 2. Find partner
        $partner = \App\Models\User::where('pairing_code', $this->partnerCode)->first();

        if (!$partner) {
            $this->addError('partnerCode', 'Invalid partner code.');
            return;
        }

        // 3. Check if partner is already coupled
        if ($partner->couple_id) {
            $this->addError('partnerCode', 'This user is already connected.');
            return;
        }

        // 4. Create Couple
        // Note: arbitrarily assigning husband/wife for now since gender isn't tracked yet
        $couple = \App\Models\Couple::create([
            'husband_id' => $user->id,
            'wife_id' => $partner->id,
            'pairing_code' => strtoupper(substr(md5(uniqid()), 0, 6)), // Unique code for the HEAD couple entity
            'anniversary_date' => now(), // Default to today
        ]);

        // 5. Update both users
        $user->update(['couple_id' => $couple->id]);
        $partner->update(['couple_id' => $couple->id]);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.partner-coupling');
    }
}

