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
                'content' => 'Selamat datang di Invisible Bridge. Ceritakan apa yang kamu rasakan, aku siap mendengarkan dan membantu mencari solusi psikologis untuk hubunganmu.'
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

        // Clear input and set loading state
        $userInput = $this->userMessage;
        $this->userMessage = '';
        $this->isLoading = true;

        // Trigger AI response generation asynchronously
        $this->dispatch('generate-ai-response', userInput: $userInput);
    }

    #[\Livewire\Attributes\On('generate-ai-response')]
    public function generateAIResponse($userInput, \App\Services\AmoraService $amoraService)
    {
        try {
            $response = $amoraService->chatWithPsychologist($userInput, $this->messages);
            
            if ($response && isset($response['reply'])) {
                $this->messages[] = [
                    'type' => 'amora',
                    'content' => $response['reply']
                ];
            } else {
                $this->messages[] = [
                    'type' => 'system',
                    'content' => 'Maaf, saya sedang kesulitan terhubung. Coba lagi nanti ya.'
                ];
            }
        } catch (\Exception $e) {
            $this->messages[] = [
                'type' => 'system',
                'content' => 'Terjadi kesalahan sistem.'
            ];
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.invisible-bridge');
    }
}
