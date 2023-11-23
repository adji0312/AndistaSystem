<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Frequency;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            BrandSeeder::class,
            SupplierSeeder::class,
            CategoryProductSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            PetSeeder::class,
            StaffSeeder::class,
            RoleSeeder::class,
            PositionSeeder::class,
            CountrySeeder::class,
            FrequencySeeder::class
        ]);
    }
}
