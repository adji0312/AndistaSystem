<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
use Illuminate\Support\Carbon;

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
                "position_name"=>"Dokter"
            ],
            [
                "position_name"=>"Resepsionis"
            ],
            [
                "position_name"=>"Frontliner"
            ],
            [
                "position_name"=>"Asisten Dokter"
            ],            
        ]);
    }
}
