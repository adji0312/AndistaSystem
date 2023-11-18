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
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'1',
                'nickname'=>'zokowi1',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
            [
                'role_id'=>'2',
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'2',
                'nickname'=>'zokowi2',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
            [
                'role_id'=>'3',
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'3',
                'nickname'=>'zokowi3',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
            [
                'role_id'=>'4',
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'4',
                'nickname'=>'zokowi4',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
            [
                'role_id'=>'5',
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'5',
                'nickname'=>'zokowi5',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
            [
                'role_id'=>'6',
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'6',
                'nickname'=>'zokowi6',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
            [
                'role_id'=>'7',
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'7',
                'nickname'=>'zokowi7',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
            [
                'role_id'=>'4',
                'service_id'=>'1',
                'first_name'=>'Joko',
                'middle_name'=>'ui',
                'last_name'=>'8',
                'nickname'=>'zokowi8',
                'gender'=>'male',
                'status'=>'oke',
                'descriptions'=>'mantap',
                'phone'=>'123456789',
                'email'=>'a@yahoo.com',
                'image'=>'pathtoimage',
                'uuid'=> Str::uuid()
            ],
        ]);
    }
}
