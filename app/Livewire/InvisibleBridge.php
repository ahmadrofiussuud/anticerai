<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class InvisibleBridge extends Component
{
    public $userMessage = '';
    public $messages = [];
    public $isLoading = false;

    public function mount()
    {
        // Initialize with a welcome message
        $this->messages = [
            [
                'type' => 'system',
                'content' => 'Welcome to Invisible Bridge. Share your feelings and I\'ll help you communicate better with your partner using Non-Violent Communication.'
            ]
        ];
    }

    public function sendMessage()
    {
        if (empty(trim($this->userMessage))) {
            return;
        }

        // Add user message
        $this->messages[] = [
            'type' => 'user',
            'content' => $this->userMessage
        ];

        $userInput = $this->userMessage;
        $this->userMessage = '';
        $this->isLoading = true;

        // Simulate AI response (you can integrate with Amora service here)
        $this->messages[] = [
            'type' => 'amora',
            'content' => 'NVC suggestion: try expressing your feelings and needs. "I feel sad when I am not listened to because I need understanding."'
        ];

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.invisible-bridge');
    }
}
