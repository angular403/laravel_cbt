<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
        ];

        foreach ($permission as $permission) {
            Permission::create_function([
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

        $studentRole = Role::create([
            'name' => 'student'
        ]);

        $studentRole->givePermissionTo(
            [
                'view courses',
            ]
        );


        $user = User::create([
            'name'=> 'fany',
            'email'=> 'fany@teacher.com',
            'password'=> bcrypt(12345678),
        ]);

        $user->assignRole($teacherRole);
    }
}
