<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Staff::insert([
            [
                'role_id'=>'1',
                'position_id'=>'1',
                'first_name'=>'Joko1',
                'middle_name'=>'ui',
                'last_name'=>'1',
                'nickname'=>'zokowi1',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'messenger'=>'@jokoui',
                'uuid'=> Str::uuid(),
                'address'=>"Jl in aja dulu",
                "shifts_id"=>"1"
            ],
            [
                'role_id'=>'2',
                'position_id'=>'2',
                'first_name'=>'Joko2',
                'middle_name'=>'ui',
                'last_name'=>'2',
                'nickname'=>'zokowi2',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'messenger'=>'@jokoui',
                'uuid'=> Str::uuid(),
                'address'=>"Jl in aja dulu",
                "shifts_id"=>"1"
            ],
            [
                'role_id'=>'3',
                'position_id'=>'3',
                'first_name'=>'Joko3',
                'middle_name'=>'ui',
                'last_name'=>'3',
                'nickname'=>'zokowi3',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'messenger'=>'@jokoui',
                'uuid'=> Str::uuid(),
                'address'=>"Jl in aja dulu",
                "shifts_id"=>"1"
            ],
            [
                'role_id'=>'4',
                'position_id'=>'4',
                'first_name'=>'Joko2',
                'middle_name'=>'ui',
                'last_name'=>'4',
                'nickname'=>'zokowi4',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'messenger'=>'@jokoui',
                'uuid'=> Str::uuid(),
                'address'=>"Jl in aja dulu",
                "shifts_id"=>"1"
            ],
            [
                'role_id'=>'5',
                'position_id'=>'5',
                'first_name'=>'Joko5',
                'middle_name'=>'ui',
                'last_name'=>'2',
                'nickname'=>'zokowi5',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'messenger'=>'@jokoui',
                'uuid'=> Str::uuid(),
                'address'=>"Jl in aja dulu",
                "shifts_id"=>"1"
            ],
            [
                'role_id'=>'6',
                'position_id'=>'6',
                'first_name'=>'Joko6',
                'middle_name'=>'ui',
                'last_name'=>'6',
                'nickname'=>'zokowi6',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'messenger'=>'@jokoui',
                'uuid'=> Str::uuid(),
                'address'=>"Jl in aja dulu",
                "shifts_id"=>"1"
            ],
            [
                'role_id'=>'7',
                'position_id'=>'7',
                'first_name'=>'Joko7',
                'middle_name'=>'ui',
                'last_name'=>'7',
                'nickname'=>'zokowi7',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'messenger'=>'@jokoui',
                'uuid'=> Str::uuid(),
                'address'=>"Jl in aja dulu",
                "shifts_id"=>"1"
            ],
        ]);
    }
}
