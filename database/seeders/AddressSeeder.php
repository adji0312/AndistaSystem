<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Address::insert([
        [
            "customer_id"=>"1",
            'country_id'=>"1",
            'address_name'=>"Jl Melati Mas no 32",
            'detail_address'=>"Jl Melati Mas no 32 RT 05 RW 09",
            'city'=>"Tangerang",
            'province'=>"Banten",
            'postal_code'=>"111111",
            'country'=>"Indonesia",
            'religion'=>"Buddha",
            'marital_status'=>"yes"
        ]
        ]);
    }
}
