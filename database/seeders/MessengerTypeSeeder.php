<?php

namespace Database\Seeders;

use App\Models\MessengerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessengerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MessengerType::insert([
            [
                "type_name"=>"Facebook"
            ],
            [
                "type_name"=>"Twitter"
            ],
            [
                "type_name"=>"Instagram"
            ],
            [
                "type_name"=>"Other"
            ]
        ]);
    }
}
