<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission::create(['name' => 'edit post']);
        // Permission::create(['name' => 'delete post']);
        // Permission::create(['name' => 'view users']);
        // Permission::create(['name' => 'create post']);
        // Permission::create(['name' => 'approve post']);
        // Permission::create(['name' => 'user account confirmation']);

        // $roleCeo = Role::create(['name' => 'Ceo']);
        // $roleManager = Role::create(['name' => 'Manager']);
        // $roleTeamLead = Role::create(['name' => 'Team Lead']);
        // $roleDeveloper = Role::create(['name' => 'Developer']);

        // $roleCeo->givePermissionTo(['edit post', 'delete post', 'view users', 'create post', 'approve post','user account confirmation']);
        // $roleManager->givePermissionTo(['edit post', 'view users', 'create post', 'approve post','user account confirmation']);
        // $roleTeamLead->givePermissionTo(['edit post', 'view users', 'create post']);
        // $roleDeveloper->givePermissionTo(['create post']);
    }
}
