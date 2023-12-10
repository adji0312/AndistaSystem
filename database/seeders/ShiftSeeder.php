<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Shift::insert([
            [
                'shift_name' => 'Morning',
                'start_hour' => '08:00:00',
                'end_hour' => '16:00:00',
            ],
            [
                'shift_name' => 'Afternoon',
                'start_hour' => '16:00:00',
                'end_hour' => '00:00:00',
            ],
            [
                'shift_name' => 'Night',
                'start_hour' => '00:00:00',
                'end_hour' => '08:00:00',
            ]
        ]);
    }
}
