<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Http;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

$apiKey = env('GEMINI_API_KEY');

if (!$apiKey) {
    echo "API Key not found in .env\n";
    exit(1);
}

echo "Using API Key: " . substr($apiKey, 0, 5) . "...\n";

$url = "https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}";

$response = Http::get($url);

if ($response->successful()) {
    $models = $response->json()['models'] ?? [];
    echo "Available Models:\n";
    foreach ($models as $model) {
        echo "- " . $model['name'] . "\n";
    }
} else {
    echo "Failed to list models. Status: " . $response->status() . "\n";
    echo "Body: " . $response->body() . "\n";
}
