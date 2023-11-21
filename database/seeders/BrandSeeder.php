<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Brand::Insert([
            [
                'brand_name'=>'whiskas'
            ],
            [
                'brand_name'=>'pet fill'
            ],
        ]);
    }
}
