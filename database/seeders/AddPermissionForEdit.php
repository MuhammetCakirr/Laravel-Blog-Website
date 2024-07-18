<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddPermissionForEdit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'edit role']);
        $roleCeo = Role::firstOrCreate(['name' => 'Ceo']);
        $roleManager = Role::firstOrCreate(['name' => 'Manager']);
        $roleCeo->givePermissionTo('edit role');
        $roleManager->givePermissionTo('edit role');
    }
}
