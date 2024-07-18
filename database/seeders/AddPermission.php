<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'direct post creation']);
        $roleCeo = Role::firstOrCreate(['name' => 'Ceo']);
        $roleManager = Role::firstOrCreate(['name' => 'Manager']);
        $roleCeo->givePermissionTo('direct post creation');
        $roleManager->givePermissionTo('direct post creation');
    }
}
