<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $cityIds = City::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            Customer::create([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'city_id'    => $faker->randomElement($cityIds),
            ]);
        }
    }
}
