<?php

namespace Tests\Feature;

use App\Livewire\DateNightRoulette;
use App\Models\Activity;
use App\Models\Couple;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RouletteVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_activities_can_be_seeded()
    {
        $this->seed(\Database\Seeders\ActivitySeeder::class);
        $this->assertDatabaseCount('activities', 15);
    }

    public function test_can_shuffle_activities()
    {
        $this->seed(\Database\Seeders\ActivitySeeder::class);
        $couple = $this->createCouple();

        $this->actingAs($couple->husband);

        Livewire::test(DateNightRoulette::class)
            ->call('shuffle')
            ->assertSet('isShuffling', false)
            ->assertSet('showResults', true)
            ->assertCount('candidates', 3);
    }

    public function test_can_select_plan()
    {
        $this->seed(\Database\Seeders\ActivitySeeder::class);
        $couple = $this->createCouple();
        $activity = Activity::first();

        $this->actingAs($couple->husband);

        Livewire::test(DateNightRoulette::class)
            ->call('select', $activity->id)
            ->assertRedirect(route('dashboard'));

        $this->assertEquals($activity->id, $couple->refresh()->current_plan_id);
    }

    public function test_can_cancel_plan()
    {
        $this->seed(\Database\Seeders\ActivitySeeder::class);
        $couple = $this->createCouple();
        $activity = Activity::first();
        $couple->update(['current_plan_id' => $activity->id]);

        $this->actingAs($couple->husband);

        Livewire::test(DateNightRoulette::class)
            ->call('cancelPlan')
            ->assertRedirect(route('dashboard'));

        $this->assertNull($couple->refresh()->current_plan_id);
    }

    private function createCouple()
    {
        $husband = User::factory()->create();
        $wife = User::factory()->create();
        $couple = Couple::create(['husband_id' => $husband->id, 'wife_id' => $wife->id, 'pairing_code' => 'TEST12']);
        $husband->update(['couple_id' => $couple->id]);
        $wife->update(['couple_id' => $couple->id]);
        return $couple;
    }
}
