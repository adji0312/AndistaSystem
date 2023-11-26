<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Policy::insert([
            [
                "form_name"=>"MyPolicy",
                "text"=>"<p>MyPolicy</p>"
            ]
        ]);
    }
}
