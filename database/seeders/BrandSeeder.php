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
            [
                'brand_name'=>'pepsodent'
            ],
            [
                'brand_name'=>'sensodyne'
            ],
            [
                'brand_name'=>'royal canin'
            ],
            [
                'brand_name'=>'pedigree'
            ],
            [
                'brand_name'=>'purina'
            ],
            [
                'brand_name'=>'friskies'
            ],
            
        ]);
    }
}
