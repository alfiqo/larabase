<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit todos']);
        Permission::create(['name' => 'delete todos']);
        Permission::create(['name' => 'create todos']);
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'view profile']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('create todos');
        $role1->givePermissionTo('edit todos');
        $role1->givePermissionTo('view dashboard');
        $role1->givePermissionTo('view profile');


        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('create todos');
        $role2->givePermissionTo('edit todos');
        $role2->givePermissionTo('delete todos');
        $role2->givePermissionTo('view dashboard');
        $role2->givePermissionTo('view profile');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@larabase.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@larabase.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@larabase.com',
        ]);
        $user->assignRole($role3);
    }
}
