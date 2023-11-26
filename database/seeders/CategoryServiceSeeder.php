<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CategoryService::insert([
            [
                "category_service_name"=>"Sample Service"
            ]
        ]);
    }
}
