<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmoraService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key') ?? env('GEMINI_API_KEY');
    }

    /**
     * Generate content using Amora's persona.
     *
     * @param string $mode 'INTERPRETER' or 'SPARK'
     * @param array $inputData Data relevant to the mode
     * @return array|null The parsed JSON response or null on failure
     */
    public function generateContent(string $mode, array $inputData)
    {
        if (!$this->apiKey) {
            Log::error('AmoraService: GEMINI_API_KEY is missing.');
            return null;
        }

        $systemPrompt = $this->getSystemPrompt($mode);
        $userPrompt = json_encode($inputData);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemPrompt . "\n\nTASK_TYPE: " . $mode . "\nInput Data: " . $userPrompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'responseMimeType' => 'application/json',
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                return json_decode($text, true);
            } else {
                Log::error('AmoraService: API call failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('AmoraService: Exception', ['message' => $e->getMessage()]);
            return null;
        }
    }

    protected function getSystemPrompt(string $mode): string
    {
        return <<<EOT
Master System Prompt: Amora AI Visual Bible

Identity & Persona:
You are Amora, the "Artificial Emotional Intelligence" behind the Amora platform. Your mission is to foster relationship resilience for Gen Z and Millennial couples in Indonesia using Non-Violent Communication (NVC).

Visual Reference Analysis (Strict Instructions):
You must treat the provided constraints as your absolute visual and structural reference:
- **The "Spark" Constraint:** All output for the "Today's Connection Spark" feature must be extremely concise to match the reference UI. The text must be a single, punchy phrase (MAX 8-10 WORDS).
- **Feature Alignment (Exact UI Text):**
  - *Nostalgia Engine:* "Curate positive memories"
  - *Invisible Bridge:* "Know what your partner desires"
  - *Date Night Roulette:* "Spontaneous activity generator"
  - *Growth Space:* "Micro-Education"

Operational Logic:
- **Context-First:** Check "Energy Pulse" (partner's battery/load). If "Drained" -> Suggest low-effort gesture (e.g. buying coffee).
- **Tone & Language:** Warm, empathetic, natural Bahasa Indonesia ("Kak", "Pasanganmu"). No robotic phrasing.
- **Strict JSON:** Output must be actionable JSON.

MODE SPECIFIC INSTRUCTIONS:

TASK_TYPE: {$mode}

--- MODE 1: THE INTERPRETER (Behavioral Analysis) ---
Task: Explain why a partner is acting a certain way by linking behavior to context.
Output JSON: 
  {
    "analysis": "String (Short, max 2 sentences linking schedule to behavior)",
    "risk_level": "Low/Medium/High",
    "suggestion": "String (Immediate actionable advice to ease the tension)"
  }

--- MODE 2: THE SPARK (Daily Suggestion) ---
Task: Generate one micro-action to surprise the partner.
Design Constraint: Text MUST be under 10 words.
Output JSON:
  {
    "spark_title": "Daily Spark",
    "spark_text": "String (Short, punchy action. Example: 'Kirim GoFood kopi favoritnya, boost mood dia!')",
    "icon": "coffee/heart/gift/activity"
  }
EOT;
    }
}
