<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyLog;

class DailyLogWidget extends Component
{
    public $activity = '';
    public $note = '';
    public $category = 'physical'; // 'physical' or 'mental'
    public $intensity = 'medium'; // 'low', 'medium', 'high'

    protected $rules = [
        'activity' => 'required|string|max:255',
        'note' => 'nullable|string|max:1000',
        'category' => 'required|in:physical,mental',
        'intensity' => 'required|in:low,medium,high',
    ];

    public function setCategory($cat)
    {
        $this->category = $cat;
    }

    public function setIntensity($int)
    {
        $this->intensity = $int;
    }

    public function save(\App\Services\AmoraService $amora)
    {
        $this->validate();

        $log = DailyLog::create([
            'user_id' => auth()->id(),
            'activity' => $this->activity,
            'note' => $this->note,
            'category' => $this->category,
            'intensity' => $this->intensity,
        ]);

        // Trigger AI Analysis if coupled
        if (auth()->user()->couple_id) {
            $analysis = $amora->analyzePartnerState($log);
            if ($analysis) {
                // Store this analysis in cache for the partner to see in their EnergyMeter
                \Illuminate\Support\Facades\Cache::put('partner_analysis_' . auth()->user()->couple_id . '_' . auth()->id(), $analysis, now()->addHours(12));
            }
        }

        $this->reset(['activity', 'note']);
        session()->flash('success', 'Kegiatan berhasil dicatat!');
    }

    public function delete($id)
    {
        $log = DailyLog::find($id);
        if ($log && $log->user_id === auth()->id()) {
            $log->delete();
        }
    }

    public function render()
    {
        $logs = DailyLog::where('user_id', auth()->id())
            ->whereDate('created_at', now()->today())
            ->latest()
            ->get();

        return view('livewire.daily-log-widget', [
            'logs' => $logs
        ]);
    }
}
