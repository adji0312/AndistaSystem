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
                'shift_name' => 'Malam',
                'start_hour' => '00:00',
                'end_hour' => '08:00',
                'jam_mulai' => '23:50',
                'jam_berakhir' => '00:05'
            ],
            [
                'shift_name' => 'Pagi',
                'start_hour' => '08:00',
                'end_hour' => '16:00',
                'jam_mulai' => '07:50',
                'jam_berakhir' => '08:05'
            ],
            [
                'shift_name' => 'Sore',
                'start_hour' => '16:00',
                'end_hour' => '00:00',
                'jam_mulai' => '15:50',
                'jam_berakhir' => '16:05'
            ],
            [
                'shift_name' => 'Siang',
                'start_hour' => '13:00',
                'end_hour' => '21:00',
                'jam_mulai' => '12:50',
                'jam_berakhir' => '13:05'
            ],
            [
                'shift_name' => 'Libur',
                'start_hour' => '-',
                'end_hour' => '-',
                'jam_mulai' => '-',
                'jam_berakhir' => '-'
            ],
        ]);
    }
}
