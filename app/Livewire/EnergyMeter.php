<?php

namespace App\Livewire;

use App\Models\EnergyLog;
use Livewire\Component;

class EnergyMeter extends Component
{
    public $energyLevel = 3;
    public $note = '';
    
    // Polling for real-time partner updates
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        // Set initial value to user's last log today if exists
        $lastLog = auth()->user()->energyLogs()->latest()->first();
        if ($lastLog && $lastLog->created_at->isToday()) {
            $this->energyLevel = $lastLog->energy_level;
            $this->note = $lastLog->note;
        }
    }

    public function save()
    {
        $this->validate([
            'energyLevel' => 'required|integer|min:1|max:5',
            'note' => 'nullable|string|max:255',
        ]);

        EnergyLog::create([
            'user_id' => auth()->id(),
            'energy_level' => $this->energyLevel,
            'note' => $this->note,
        ]);

        session()->flash('status', 'Energy updated! Your partner will know.');
    }

    public function getPartnerStatusProperty()
    {
        $couple = auth()->user()->couple; 
        if (!$couple) return null;

        $partnerId = ($couple->husband_id === auth()->id()) ? $couple->wife_id : $couple->husband_id;
        if (!$partnerId) return null;

        $log = EnergyLog::where('user_id', $partnerId)->latest()->first();

        // Only show status from last 24 hours
        if (!$log || $log->created_at->diffInHours(now()) > 24) {
            return [
                'level' => 0,
                'message' => "Waiting for partner's update...",
                'color' => 'gray',
                'updated_at' => null // Fixed missing key
            ];
        }

        $level = $log->energy_level;
        $message = '';
        $color = '';

        if ($level <= 2) {
            $message = "Peringatan: Energi pasanganmu sedang low. Berikan dia ruang atau bawakan camilan tanpa banyak bertanya.";
            $color = 'rose';
        } elseif ($level === 5) {
            $message = "Pasanganmu sedang on fire! Waktu yang tepat untuk diskusi seru atau ajak jalan-jalan.";
            $color = 'amber';
        } else {
            $message = "Energi pasangan sedang stabil.";
            $color = 'green';
        }

        return [
            'level' => $level,
            'message' => $message,
            'note' => $log->note,
            'color' => $color,
            'updated_at' => $log->created_at->diffForHumans(),
        ];
    }

    public function render()
    {
        return view('livewire.energy-meter', [
            'partnerStatus' => $this->getPartnerStatusProperty()
        ]);
    }
}
