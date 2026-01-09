<?php

namespace Tests\Feature;

use App\Models\Couple;
use App\Models\User;
use App\Services\CoupleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CouplePairingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_generate_pairing_code()
    {
        $user = User::factory()->create();
        $service = new CoupleService();

        $couple = $service->generatePairingCode($user);

        $this->assertNotNull($couple->pairing_code);
        $this->assertEquals(6, strlen($couple->pairing_code));
        $this->assertEquals($user->id, $couple->husband_id); // Default logic
        $this->assertEquals($couple->id, $user->refresh()->couple_id);
    }

    public function test_user_can_pair_with_code()
    {
        $husband = User::factory()->create();
        $service = new CoupleService();
        $couple = $service->generatePairingCode($husband);

        $wife = User::factory()->create();
        $updatedCouple = $service->pairUsers($wife, $couple->pairing_code);

        $this->assertEquals($husband->id, $updatedCouple->husband_id);
        $this->assertEquals($wife->id, $updatedCouple->wife_id);
        $this->assertEquals($couple->id, $wife->refresh()->couple_id);
    }

    public function test_cannot_pair_logic_violations()
    {
        $service = new CoupleService();
        $userA = User::factory()->create();
        $couple = $service->generatePairingCode($userA);

        // 1. User A cannot generate again
        try {
            $service->generatePairingCode($userA);
            $this->fail('Should not allow generating code if already paired/pending');
        } catch (ValidationException $e) {
            $this->assertTrue(true);
        }

        // 2. User B joins, checks full
        $userB = User::factory()->create();
        $service->pairUsers($userB, $couple->pairing_code);

        $userC = User::factory()->create();
        try {
            $service->pairUsers($userC, $couple->pairing_code);
            $this->fail('Should not allow joining full couple');
        } catch (ValidationException $e) {
             $this->assertTrue(true);
        }
    }
}
