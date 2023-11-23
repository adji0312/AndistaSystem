<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pet::insert([
            [
                "customer_id"=>"1",
                "pet_name"=>"Moshi",
                "pet_type"=>"kucing",
                "pet_ras"=>"persia",
                "pet_gender"=>"female",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "pet_color"=>"white"
            ],
            [
                "customer_id"=>"2",
                "pet_name"=>"Niko",
                "pet_type"=>"anjing",
                "pet_ras"=>"herder",
                "pet_gender"=>"male",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "pet_color"=>"white"
            ],
            [
                "customer_id"=>"3",
                "pet_name"=>"Vinki",
                "pet_type"=>"Kerbau",
                "pet_ras"=>"persia",
                "pet_gender"=>"perempuan",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "pet_color"=>"white"
            ],
            [
                "customer_id"=>"4",
                "pet_name"=>"Venti",
                "pet_type"=>"Kerbau",
                "pet_ras"=>"persia",
                "pet_gender"=>"perempuan",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "pet_color"=>"white"
            ]
        ]);
    }
}
