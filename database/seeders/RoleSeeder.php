<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::insert(
            [
                [
                    'role_name' => 'Administrator',
                    'staff_access_control' => '1'
                ],
                [
                    'role_name' => 'Manager',
                    'staff_access_control' => '1'
                ],
                [
                    'role_name' => 'Veterinarian',
                    'staff_access_control' => '4'
                ],
                [
                    'role_name' => 'Veterinary Assistant',
                    'staff_access_control' => '4'
                ],
                [
                    'role_name' => 'Receptionist',
                    'staff_access_control' => '4'
                ],
                [
                    'role_name' => 'Support',
                    'staff_access_control' => '4'
                ],
                [
                    'role_name' => 'Multimedia Staff',
                    'staff_access_control' => '4'
                ],
                [
                    'role_name' => 'PC Absensi',
                    'staff_access_control' => '4'
                ],
                [
                    'role_name' => 'Staff Manager',
                    'staff_access_control' => '4'
                ],
                ]
                );
    }
}
