<?php

namespace Database\Seeders;

use App\Models\Frequency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Frequency::create([
            'frequency_value' => 1, 
            'frequency_name' => 'Once per day'
        ]);
        Frequency::create([
            'frequency_value' => 2, 
            'frequency_name' => 'Twice per day'
        ]);
        Frequency::create([
            'frequency_value' => 3, 
            'frequency_name' => 'Thrice per day'
        ]);
        Frequency::create([
            'frequency_value' => 4, 
            'frequency_name' => 'Four times per day'
        ]);
        Frequency::create([
            'frequency_value' => 1, 
            'frequency_name' => 'Every 3 days'
        ]);
        Frequency::create([
            'frequency_value' => 1, 
            'frequency_name' => 'Once a week'
        ]);
        Frequency::create([
            'frequency_value' => 1, 
            'frequency_name' => 'Once every 2 weeks'
        ]);
        Frequency::create([
            'frequency_value' => 1, 
            'frequency_name' => 'Once every 4 weeks'
        ]);
        Frequency::create([
            'frequency_value' => 12, 
            'frequency_name' => 'Every 2 hours'
        ]);
        Frequency::create([
            'frequency_value' => 6, 
            'frequency_name' => 'Every 4 hours'
        ]);
        Frequency::create([
            'frequency_value' => 3, 
            'frequency_name' => 'Every 8 hours'
        ]);
        Frequency::create([
            'frequency_value' => 2, 
            'frequency_name' => 'Every 12 hours'
        ]);
    }
}
