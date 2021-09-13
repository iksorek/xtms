<?php

namespace Tests\Feature;

use App\Models\Run;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use function Symfony\Component\Translation\t;

class AdminTest extends TestCase
{

    public function test_admin_see_admin_link()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $response = $this->get('/dashboard');
        $response->assertSee('Admin');
    }

    public function test_admin_can_load_admin_page()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertSee('Administration');
    }

    public function test_non_admin_can_not_see_admin_link()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/dashboard');
        $response->assertDontSee('Admin');
    }

    public function test_non_admin_can_not_load_admin_page()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertDontSee('Administration');
    }

    public function test_admin_can_see_users_list()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertSeeText('Users list');

    }

    public function test_non_admin_cant_see_users_list()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertDontSeeText('Users list');

    }

    public function test_admin_can_see_any_run()
    {
        User::factory(20)
            ->hasRuns(20)
            ->create();
        Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $randomRun = Run::inRandomOrder()->first();
        $response = $this->get('/run/' . $randomRun->id);
        $response->assertSeeText('Route');


    }
    public function test_admin_can_see_any_vehicle()
    {
        User::factory(20)
            ->hasVehicles(20)
            ->create();
        Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $randomVeh = Vehicle::inRandomOrder()->first();
        $response = $this->get('/vehicledetails/' . $randomVeh->id);
        $response->assertSeeText('Registration number');


    }
}
