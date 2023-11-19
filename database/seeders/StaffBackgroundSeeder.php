<?php

namespace Database\Seeders;

use App\Models\StaffBackground;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffBackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        StaffBackground::insert([
            [
                'id_type_id'=>'1',
                'no_id'=>'2',
                'staff_id'=>'1',
            ]
            ]);
    }
}
