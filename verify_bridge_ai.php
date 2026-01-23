<?php

use App\Services\AmoraService;
use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

$service = new AmoraService();
echo "Testing chatWithPsychologist...\n";
$response = $service->chatWithPsychologist("Saya merasa sedih karena pasangan saya tidak mendengarkan saya.");

if ($response && isset($response['reply'])) {
    echo "SUCCESS:\n";
    echo $response['reply'] . "\n";
} else {
    echo "FAILED:\n";
    print_r($response);
}

// Also test invalid input handling (optional)
