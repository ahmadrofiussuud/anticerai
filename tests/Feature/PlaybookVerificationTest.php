<?php

namespace Tests\Feature;

use App\Livewire\PartnershipPlaybook;
use App\Models\Couple;
use App\Models\EnergyLog;
use App\Models\Insight;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PlaybookVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_playbook_detects_low_energy()
    {
        // Setup data
        $insight = Insight::create([
            'title' => 'Low Energy Tip',
            'type' => 'text',
            'brief_text' => 'Rest',
            'trigger_context' => 'low_energy'
        ]);
        
        // Setup couple
        $husband = User::factory()->create();
        $wife = User::factory()->create();
        $couple = Couple::create(['husband_id' => $husband->id, 'wife_id' => $wife->id, 'pairing_code' => 'TESTPB']);
        $husband->update(['couple_id' => $couple->id]);
        $wife->update(['couple_id' => $couple->id]);

        // Husband logs LOW energy (level 1)
        EnergyLog::create(['user_id' => $husband->id, 'energy_level' => 1]);

        // Wife views playbook
        $this->actingAs($wife);

        Livewire::test(PartnershipPlaybook::class)
            ->assertSee('Low Energy Tip')
            ->assertSee('Partner needs you');
    }

    public function test_user_can_save_insight()
    {
        $user = User::factory()->create();
        $insight = Insight::create([
            'title' => 'Random Tip',
            'type' => 'text',
            'brief_text' => 'Be happy',
            'trigger_context' => 'random'
        ]);

        $this->actingAs($user);

        Livewire::test(PartnershipPlaybook::class)
            ->call('toggleSave')
            ->assertSet('isSaved', true);
            
        $this->assertTrue($user->savedInsights()->where('insight_id', $insight->id)->exists());
    }
}
