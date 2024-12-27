<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cek jika user dengan username 'admin' sudah ada
        $user = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('asdfasdf'),
                'status'   => 1,
            ]
        );

        $roles = ['superadmin'];
        $data = ['master', 'role', 'pegawai', 'poli', 'pengunjung', 'antrian', 'doctor'];

        // Membuat data permission jika belum ada
        foreach ($data as $permission) {
            Permission::firstOrCreate([
                'name'       => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Memberikan hak akses (role) kepada user 'superadmin'
        foreach ($roles as $roleName) {
            // Cek jika role sudah ada
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            // Sinkronisasi permission untuk memastikan role memiliki semua permission yang diinginkan
            $role->syncPermissions(Permission::all());
            // Berikan role kepada user jika belum memiliki role tersebut
            if (!$user->hasRole($roleName)) {
                $user->assignRole($role);
            }
        }
    }
}
