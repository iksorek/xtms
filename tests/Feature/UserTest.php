<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_cant_see_any_vehicle()
    {
        User::factory(20)
            ->hasVehicles(20)
            ->create();
        Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($user);
        $randomVeh = Vehicle::inRandomOrder()->first();
        if ($user->Vehicles()->where('id', $randomVeh->id)->exists()) {
            $randomVeh = Vehicle::inRandomOrder()->first();
        }
        $response = $this->get('/vehicledetails/' . $randomVeh->id);
        $response->assertDontSeeText('Registration number');
    }

    public function test_user_can_see_own_vehicle()
    {

        User::factory(10)
            ->hasVehicles(10)
            ->create();
        $user = User::inRandomOrder()->first();
        $this->actingAs($user);
        $randomVeh = Vehicle::where('user_id', $user->id)->first();
        $response = $this->get('/vehicledetails/' . $randomVeh->id);
        $response->assertSeeText('Registration number');
    }
}
