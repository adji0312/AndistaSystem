<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Customer::insert([
            [
                "client_grup_id"=>'1',
                "location_id"=>'1',
                "first_name"=>'Sadikin',
                'middle_name'=>'Surya',
                'last_name'=>'pranata',
                'degree'=>'Tn',
                'nickname'=>'Sadikin',
                'phone'=>'082938292831',
                'email'=>'gmail@sadikin.com',
                'image'=>'pathtoimage',
            ]
            ]);
    }
}
