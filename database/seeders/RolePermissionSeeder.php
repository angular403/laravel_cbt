<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{

    public function run(): void
    {
        $permissions = [
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $teacherRole = Role::create([
            'name' => 'teacher'
        ]);

        $teacherRole->givePermissionTo(
            [
                'view courses',
                'create courses',
                'edit courses',
                'delete courses',
            ]
        );

        $studentRole = Role::firstOrCreate([
            'name' => 'student'
        ]);

        $studentRole->givePermissionTo([
            'view courses',
        ]);

        $user = User::firstOrCreate([
            'name' => 'Fany',
            'email' => 'fany@teacher.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole($teacherRole);
    }
}
