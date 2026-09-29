<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfficeViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_office_route_renders_the_recovered_living_office_for_an_owner(): void
    {
        $owner = User::factory()->create(['is_office_owner' => true]);

        $this->actingAs($owner)->get('/office')
            ->assertOk()
            ->assertSee('living-office-root');
    }
}
