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
                "position_name"=>"Dokter Umum"
            ],
            [
                "position_name"=>"Front Office"
            ],
            [
                "position_name"=>"Divisi Multimedia dan Keuangan"
            ],
            [
                "position_name"=>"Manajer"
            ],            
            [
                "position_name"=>"Paramedis Rawat Inap"
            ], 
            [
                "position_name"=>"Divisi Laboratorium dan Radiologi"
            ], 
            [
                "position_name"=>"Kepala Klinik"
            ],
            
        ]);
    }
}
