<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Run;
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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => 'admin']);


        User::factory(10)
            ->has(Customer::factory(rand(5, 15)))
            ->has(Vehicle::factory(rand(1, 2)))
            ->has(Run::factory(rand(10, 50)))
            ->create();

        //my super admin
        $user = User::factory()
            ->create([
                'name' => 'iksor',
                'email' => 'dev@mrogon.co.uk',
                'api_key' => 'supersecretapikey'
            ]);
        $user->assignRole('admin');

        User::factory()
            ->has(Customer::factory(50))
            ->has(Vehicle::factory(3))
            ->has(Run::factory(30))
            ->create([
                'name' => 'testuser',
                'email' => 'test@xtms.uk',
                'api_key' => 'supersecretapikey1'
            ]);


    }


}

