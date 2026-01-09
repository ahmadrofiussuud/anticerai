<?php

namespace App\Services;

use App\Models\Couple;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CoupleService
{
    public function generatePairingCode(User $user): Couple
    {
        if ($user->couple_id) {
            throw ValidationException::withMessages(['code' => 'User is already paired or has a pending code.']);
        }

        // Check if user already has a pending couple record where strictly they are the initiator (e.g. set as husband/wife but no partner)
        // For simplicity, we assume one active pairing attempt at a time.
        // Actually, we should check if they are already part of a couple.

        do {
            $code = strtoupper(Str::random(6));
        } while (Couple::where('pairing_code', $code)->exists());

        // We arbitrarily assign them as husband or wife? 
        // Or just store one and wait for the other?
        // Let's assign based on gender if we had it, but we don't.
        // We'll just create a couple with one slot filled. 
        // BUT, which slot? husband_id or wife_id?
        // Let's fill 'husband_id' by default for the initiator, and 'wife_id' for the joiner.
        // Or we can be gender neutral later, but schema has husband/wife.
        // We'll default to husband_id for initiator for now (sorry ladies, just technical default).
        
        $couple = Couple::create([
            'husband_id' => $user->id,
            'pairing_code' => $code,
        ]);

        $user->update(['couple_id' => $couple->id]);

        return $couple;
    }

    public function pairUsers(User $user, string $code): Couple
    {
        if ($user->couple_id) {
             throw ValidationException::withMessages(['code' => 'You are already paired.']);
        }

        $couple = Couple::where('pairing_code', $code)->first();

        if (!$couple) {
            throw ValidationException::withMessages(['code' => 'Invalid pairing code.']);
        }

        if ($couple->wife_id && $couple->husband_id) {
             throw ValidationException::withMessages(['code' => 'This code has already been used.']);
        }

        // Assign the joiner to the empty slot
        if (!$couple->husband_id) {
            $couple->update(['husband_id' => $user->id]);
        } else {
            $couple->update(['wife_id' => $user->id]);
        }

        $user->update(['couple_id' => $couple->id]);

        return $couple;
    }
}
