<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CategoryProduct::insert([
            [
                "category_name"=>"food"
            ],
            [
                "category_name"=>"odol"
            ],
            [
                "category_name"=>"bawang"
            ],
            [
                "category_name"=>"sabun"
            ],
            [
                "category_name"=>"garmen"
            ]
        ]);
    }
}
