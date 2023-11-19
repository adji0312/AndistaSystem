<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Position::insert([
            [
                'staff_id'=>'1',
                'job_id'=>'1',
                'start_date'=>'10/10/2023',
                'end_date'=>'10/10/2024',
            ],
            [
                'staff_id'=>'2',
                'job_id'=>'2',
                'start_date'=>'10/10/2023',
                'end_date'=>'10/10/2024',
            ],
            [
                'staff_id'=>'3',
                'job_id'=>'3',
                'start_date'=>'10/10/2023',
                'end_date'=>'10/10/2024',
            ],
            [
                'staff_id'=>'4',
                'job_id'=>'4',
                'start_date'=>'10/10/2023',
                'end_date'=>'10/10/2024',
            ],
            [
                'staff_id'=>'5',
                'job_id'=>'5',
                'start_date'=>'10/10/2023',
                'end_date'=>'10/10/2024',
            ],
            [
                'staff_id'=>'6',
                'job_id'=>'6',
                'start_date'=>'10/10/2023',
                'end_date'=>'10/10/2024',
            ],
            [
                'staff_id'=>'7',
                'job_id'=>'7',
                'start_date'=>'10/10/2023',
                'end_date'=>'10/10/2024',
            ]
            
        ]);
    }
}
