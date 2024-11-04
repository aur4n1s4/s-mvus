<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => Hash::make('asdfasdf'),
            'status'   => 1,
        ]);

        $roles = ['superadmin'];
        $permissions = ['master', 'role', 'pegawai'];

        foreach ($permissions as $permission) Permission::create(['name' => $permission, 'guard_name' => 'web']);

        $permissions = Permission::pluck('id')->all();

        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($permissions);
            $user->assignRole($role);
        }
    }
}
