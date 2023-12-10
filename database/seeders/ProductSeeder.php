<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::insert([
            [
                "category_id"=>"3",
                "brand_id"=>"2",
                "supplier_id"=>"3",
                "location_id"=>"1",
                "tax_rate_id"=>"1",
                "product_name"=>"Whishkas 100gr Food",
                "simple_name"=>"Whishkas",
                "sku"=>"009",
                "upc_ean"=>"001",
                "supplier_pid"=>"1",
                "price"=>100000,
                "stock"=>10,
                "description"=>"pet meals",
                "status"=>"active",
            ],
            [
                "category_id"=>"3",
                "brand_id"=>"2",
                "supplier_id"=>"3",
                "location_id"=>"1",
                "tax_rate_id"=>"1",
                "product_name"=>"Whishkas 100gr Food",
                "simple_name"=>"Whishkas",
                "sku"=>"009",
                "upc_ean"=>"001",
                "supplier_pid"=>"1",
                "price"=>100000,
                "stock"=>10,
                "description"=>"pet meals",
                "status"=>"active",
            ],
            [
                "category_id"=>"2",
                "brand_id"=>"2",
                "supplier_id"=>"3",
                "location_id"=>"1",
                "tax_rate_id"=>"1",
                "product_name"=>"Whishkas 100gr Food",
                "simple_name"=>"Whishkas",
                "sku"=>"009",
                "upc_ean"=>"001",
                "supplier_pid"=>"1",
                "price"=>100000,
                "stock"=>10,
                "description"=>"pet meals",
                "status"=>"active",
            ],
            [
                "category_id"=>"3",
                "brand_id"=>"3",
                "supplier_id"=>"3",
                "location_id"=>"1",
                "tax_rate_id"=>"1",
                "product_name"=>"Whishkas 100gr Food",
                "simple_name"=>"Whishkas",
                "sku"=>"009",
                "upc_ean"=>"001",
                "supplier_pid"=>"1",
                "price"=>100000,
                "stock"=>10,
                "description"=>"pet meals",
                "status"=>"active",
            ],
            [
                "category_id"=>"2",
                "brand_id"=>"2",
                "supplier_id"=>"2",
                "location_id"=>"1",
                "tax_rate_id"=>"1",
                "product_name"=>"Whishkas 100gr Food",
                "simple_name"=>"Whishkas",
                "sku"=>"009",
                "upc_ean"=>"001",
                "supplier_pid"=>"1",
                "price"=>100000,
                "stock"=>103,
                "description"=>"pet meals",
                "status"=>"active",
            ],
            [
                "category_id"=>"1",
                "brand_id"=>"3",
                "supplier_id"=>"2",
                "location_id"=>"1",
                "tax_rate_id"=>"1",
                "product_name"=>"Whishkas 500gr Food",
                "simple_name"=>"Whishkas",
                "sku"=>"009",
                "upc_ean"=>"001",
                "supplier_pid"=>"1",
                "price"=>100000,
                "stock"=>108,
                "description"=>"pet meals",
                "status"=>"active",
            ],
        ]);
    }
}
