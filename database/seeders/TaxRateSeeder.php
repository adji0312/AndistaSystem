<?php

namespace Database\Seeders;

use App\Models\TaxRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TaxRate::insert([
            [
                "tax_name"=>"PPN",
                "tax_rate"=>0.1,
                "created_by"=>"Joko",
                "updated_by"=>"Joko"
            ]
        ]);
    }
}
