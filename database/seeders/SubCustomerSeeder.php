<?php

namespace Database\Seeders;

use App\Models\SubCustomer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SubCustomer::insert([
            [
                "customer_id"=>'1',
                "sub_cust_name"=>'VIP Member'
            ]
        ]);
    }
}
