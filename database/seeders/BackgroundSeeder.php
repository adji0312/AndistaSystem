<?php

namespace Database\Seeders;

use App\Models\Background;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Background::insert([
            'customer_id'=>'1',
            'id_type_id'=>'1',
            'job_id'=>'1',
            //'no_id'=>'1',
            'join_date'=>'11-11-2023',
            'gender'=>'male',
            'birthday_date'=>'09-12-1991',
            'ethnic'=>'Sunda',
            'religion'=>'Buddha',
            'marital_status'=>'Yes'
        ]);
    }
}
