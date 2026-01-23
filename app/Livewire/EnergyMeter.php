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
             // DUMMY DATA FOR DEMO
            return [
                'level' => 3,
                'message' => "Lagi santai sambil baca buku di kamar.",
                'color' => 'green',
                'updated_at' => 'Baru saja',
                'ai_advice' => [
                    'advice_title' => 'Quality Time',
                    'advice_detail' => 'Bawakan teh hangat, dia sedang butuh time-alone yang berkualitas.',
                    'effort_level' => 'Ringan'
                ],
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

        // Get AI Advice based on partner's latest activities
        $partnerLog = \App\Models\DailyLog::where('user_id', $partnerId)->latest()->first();
        $aiAdvice = null;
        if ($partnerLog) {
            $aiAdvice = \Illuminate\Support\Facades\Cache::get('partner_analysis_' . $couple->id . '_' . $partnerId);
        }

        return [
            'level' => $level,
            'message' => $message,
            'note' => $log->note,
            'color' => $color,
            'updated_at' => $log->created_at->diffForHumans(),
            'ai_advice' => $aiAdvice,
        ];
    }

    public function render()
    {
        return view('livewire.energy-meter', [
            'partnerStatus' => $this->getPartnerStatusProperty()
        ]);
    }
}
