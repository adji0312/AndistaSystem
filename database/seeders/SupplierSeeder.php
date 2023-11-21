<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\Suppliers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Suppliers::insert([
            [
                "suppliers_name"=>"PT Wijaya Kartika"
            ],
            [
                "suppliers_name"=>"PT Kucing Sejahtera"
            ]
        ]);
    }
}
