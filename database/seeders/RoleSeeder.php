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
                    'role_name' => 'Administrator'
                ],
                [
                    'role_name' => 'Manager'
                ],
                [
                    'role_name' => 'Veterinarian'
                ],
                [
                    'role_name' => 'Veterinary Assistant'
                ],
                [
                    'role_name' => 'Receptionist'
                ],
                [
                    'role_name' => 'Support'
                ],
                [
                    'role_name' => 'Multimedia Staff'
                ]
                ]
                );
    }
}
