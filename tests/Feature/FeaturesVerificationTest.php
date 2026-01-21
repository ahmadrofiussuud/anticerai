<?php

namespace Tests\Feature;

use App\Livewire\EnergyMeter;
use App\Livewire\MemoryFlashback;
use App\Models\Couple;
use App\Models\EnergyLog;
use App\Models\Memory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FeaturesVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_energy_meter_can_save_log()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(EnergyMeter::class)
            ->set('energyLevel', 4)
            ->set('note', 'Feeling good')
            ->call('save')
            ->assertSee('Energy updated');

        $this->assertDatabaseHas('energy_logs', [
            'user_id' => $user->id,
            'energy_level' => 4,
            'note' => 'Feeling good',
        ]);
    }

    public function test_partner_status_logic()
    {
        // Setup couple
        $husband = User::factory()->create();
        $wife = User::factory()->create();
        $couple = Couple::create(['husband_id' => $husband->id, 'wife_id' => $wife->id, 'pairing_code' => 'ABCDEF']);
        $husband->update(['couple_id' => $couple->id]);
        $wife->update(['couple_id' => $couple->id]);

        // Husband logs low energy
        EnergyLog::create(['user_id' => $husband->id, 'energy_level' => 1, 'note' => 'Tired']);

        // Wife views component
        $this->actingAs($wife);
        $component = Livewire::test(EnergyMeter::class);
        
        $status = $component->get('partnerStatus');
        $this->assertEquals(1, $status['level']);
        $this->assertEquals('rose', $status['color']); // Low energy color
        $this->assertStringContainsString('Peringatan', $status['message']);
    }

    public function test_memory_flashback_creation()
    {
        $husband = User::factory()->create();
        $wife = User::factory()->create();
        $couple = Couple::create(['husband_id' => $husband->id, 'wife_id' => $wife->id, 'pairing_code' => 'XYZ123']);
        $husband->update(['couple_id' => $couple->id]);
        $wife->update(['couple_id' => $couple->id]);

        $this->actingAs($husband);

        Livewire::test(MemoryFlashback::class)
            ->set('title', 'First Date')
            ->set('description', 'It was magical')
            ->set('date', '2020-01-01')
            ->call('save')
            ->assertSee('Memory saved');

        $this->assertDatabaseHas('memories', [
            'couple_id' => $couple->id,
            'title' => 'First Date',
        ]);
    }

    public function test_memory_randomly_loads()
    {
        $husband = User::factory()->create();
        $wife = User::factory()->create();
        $couple = Couple::create(['husband_id' => $husband->id, 'wife_id' => $wife->id, 'pairing_code' => 'XYZ123']);
        $husband->update(['couple_id' => $couple->id]);
        
        Memory::create([
            'couple_id' => $couple->id,
            'title' => 'Test Memory',
            'description' => 'Test',
            'memory_date' => now(),
        ]);

        $this->actingAs($husband);

        Livewire::test(MemoryFlashback::class)
            ->assertSet('randomMemory.title', 'Test Memory');
    }
}
