<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'verify user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'add user']);
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('verify user');
        $admin->givePermissionTo('delete user');
        $admin->givePermissionTo('update user');
        $admin->givePermissionTo('add user');

        $super_admin = Role::create(['name' => 'super_admin']);
        $user = \App\Models\User::factory()
            ->has(Vehicle::factory(10))
            ->create([
            'name' => 'iksor',
            'email' => 'dev@mrogon.co.uk',
        ]);
        $user->assignRole('super_admin');


        User::factory(20)
            ->has(Vehicle::factory()->count(10))
            ->create();


    }
}

