<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
                "location_id"=>"1",
                "first_name"=>"Bambang 1",
                "middle_name"=>"Wijanarko",
                "last_name"=>"Sudjatmiko",
                "degree"=>"Tn",
                "nickname"=>"BWS",
                "phone"=>"0892383298323",
                "email"=>"bams1@y.com",
                "messenger"=>"@bambang1",
                "messengerId"=>"1",
                "address"=>"Jl. Kaliurang",
                "card_type"=>"ktp",
                "job_name"=>"Military",
                "no_id"=>"35672829292912121",
                "join_date"=>"10-10-2023",
                "gender"=>"male",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "religion"=>"islam",
            ],
            [
                "location_id"=>"1",
                "first_name"=>"Bambang 2",
                "middle_name"=>"Wijanarko",
                "last_name"=>"Sudjatmiko",
                "degree"=>"Tn",
                "nickname"=>"BWS2",
                "phone"=>"0892383298323",
                "email"=>"bams2@y.com",
                "messenger"=>"@bambang2",
                "messengerId"=>"2",
                "address"=>"Jl. Kaliurang",
                "card_type"=>"ktp",
                "job_name"=>"Military",
                "no_id"=>"35672829292912121",
                "join_date"=>"10-10-2023",
                "gender"=>"male",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "religion"=>"islam",
            ],
            [
                "location_id"=>"1",
                "first_name"=>"Bambang 3",
                "middle_name"=>"Wijanarko",
                "last_name"=>"Sudjatmiko",
                "degree"=>"Tn",
                "nickname"=>"BWS",
                "phone"=>"0892383298323",
                "email"=>"bams3@y.com",
                "messenger"=>"@bambang3",
                "messengerId"=>"3",
                "address"=>"Jl. Kaliurang",
                "card_type"=>"ktp",
                "job_name"=>"Military",
                "no_id"=>"35672829292912121",
                "join_date"=>"10-10-2023",
                "gender"=>"male",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "religion"=>"islam",
            ],
            [
                "location_id"=>"1",
                "first_name"=>"Bambang 4",
                "middle_name"=>"Wijanarko",
                "last_name"=>"Sudjatmiko",
                "degree"=>"Tn",
                "nickname"=>"BWS",
                "phone"=>"0892383298323",
                "email"=>"bams4@y.com",
                "messenger"=>"@bambang4",
                "messengerId"=>"4",
                "address"=>"Jl. Kaliurang",
                "card_type"=>"ktp",
                "job_name"=>"Military",
                "no_id"=>"35672829292912121",
                "join_date"=>"10-10-2023",
                "gender"=>"male",
                "date_of_birth"=>Carbon::parse('2000-01-01'),
                "religion"=>"islam",
            ],

            ]);
    }
}
