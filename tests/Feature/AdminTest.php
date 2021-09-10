<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

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
    public function test_admin_can_load_admin_page(){
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertSee('Administration');
    }
    public function test_non_admin_can_not_see_admin_link(){
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/dashboard');
        $response->assertDontSee('Admin');
    }

    public function test_non_admin_can_not_load_admin_page(){
        $admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertDontSee('Administration');
    }
}
