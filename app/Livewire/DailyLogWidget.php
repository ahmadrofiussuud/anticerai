<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyLog;

class DailyLogWidget extends Component
{
    public $activity = '';
    public $category = 'physical'; // 'physical' or 'mental'
    public $intensity = 'medium'; // 'low', 'medium', 'high'

    protected $rules = [
        'activity' => 'required|string|max:255',
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

    public function save()
    {
        $this->validate();

        DailyLog::create([
            'user_id' => auth()->id(),
            'activity' => $this->activity,
            'category' => $this->category,
            'intensity' => $this->intensity,
        ]);

        $this->reset('activity');
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
