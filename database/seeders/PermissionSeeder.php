<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::insert([
            [
                "permission_name"=>"Full"
            ],
            [
                "permission_name"=>"Write"
            ],
            [
                "permission_name"=>"Read"
            ],
            [
                "permission_name"=>"None"
            ]
        ]);
    }
}
