<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffAddress;

class StaffAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        StaffAddress::insert([
            [
                'staff_id'=>'1',
                'country_id'=>'1',
                'address_name'=>'jakarta',
                'detail_address'=>'jl mawar',
                'city'=>'jakarta',
                'province'=>'jakarta',
                'postal_code'=>'12345',
                'country'=>'indonesia',
                'religion'=>'hindu',
                'marital_status'=>'yes'
            ],
            [
                'staff_id'=>'2',
                'country_id'=>'1',
                'address_name'=>'jakarta',
                'detail_address'=>'jl mawar',
                'city'=>'jakarta',
                'province'=>'jakarta',
                'postal_code'=>'12345',
                'country'=>'indonesia',
                'religion'=>'hindu',
                'marital_status'=>'yes'
            ],
            [
                'staff_id'=>'3',
                'country_id'=>'1',
                'address_name'=>'jakarta',
                'detail_address'=>'jl mawar',
                'city'=>'jakarta',
                'province'=>'jakarta',
                'postal_code'=>'12345',
                'country'=>'indonesia',
                'religion'=>'hindu',
                'marital_status'=>'yes'
            ],
            [
                'staff_id'=>'4',
                'country_id'=>'1',
                'address_name'=>'jakarta',
                'detail_address'=>'jl mawar',
                'city'=>'jakarta',
                'province'=>'jakarta',
                'postal_code'=>'12345',
                'country'=>'indonesia',
                'religion'=>'hindu',
                'marital_status'=>'yes'
            ],
        ]);
    }
}
