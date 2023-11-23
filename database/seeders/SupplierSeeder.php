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
            ],
            [
                "suppliers_name"=>"PT Sari Bumi Raya"
            ],
            [
                "suppliers_name"=>"PT Alfamidi Trijaya"
            ],
            [
                "suppliers_name"=>"PT Koperasi Simpan Pinjam"
            ],
            [
                "suppliers_name"=>"PT Botol Sejahtera"
            ],
        ]);
    }
}
