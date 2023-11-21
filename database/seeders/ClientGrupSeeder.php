<?php

namespace Database\Seeders;

use App\Models\ClientGrup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientGrupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ClientGrup::insert([
            [
                "client_name"=>"VIP Customer"
            ]
        ]);
    }
}
