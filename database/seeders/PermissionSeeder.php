<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage maps']);

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());
        $user = User::where('email', 'admin@admin.com')->first();
        $user->assignRole('Admin');
    }
}
