<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'suryadi.hhb@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $manager = User::create([
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $spv = User::create([
                'name' => 'spv',
                'email' => 'spv@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $role_admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
            $role_manager = Role::create(['name' => 'manager', 'guard_name' => 'web']);
            $role_spv = Role::create(['name' => 'spv', 'guard_name' => 'web']);

            Permission::create(['name' => 'read konfigurasi']);

            Permission::create(['name' => 'read konfigurasi/roles']);
            Permission::create(['name' => 'create konfigurasi/roles']);
            Permission::create(['name' => 'update konfigurasi/roles']);
            Permission::create(['name' => 'delete konfigurasi/roles']);

            Permission::create(['name' => 'read konfigurasi/navigation']);
            Permission::create(['name' => 'create konfigurasi/navigation']);
            Permission::create(['name' => 'update konfigurasi/navigation']);
            Permission::create(['name' => 'delete konfigurasi/navigation']);

            Permission::create(['name' => 'read konfigurasi/permissions']);

            // give permissions
            $role_admin->givePermissionTo('read konfigurasi');

            $role_admin->givePermissionTo('read konfigurasi/roles');
            $role_admin->givePermissionTo('create konfigurasi/roles');
            $role_admin->givePermissionTo('update konfigurasi/roles');
            $role_admin->givePermissionTo('delete konfigurasi/roles');

            $role_admin->givePermissionTo('read konfigurasi/navigation');
            $role_admin->givePermissionTo('create konfigurasi/navigation');
            $role_admin->givePermissionTo('update konfigurasi/navigation');
            $role_admin->givePermissionTo('delete konfigurasi/navigation');

            $role_admin->givePermissionTo('read konfigurasi/permissions');

            $admin->assignRole('admin');
            $manager->assignRole('manager');
            $spv->assignRole('spv');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
