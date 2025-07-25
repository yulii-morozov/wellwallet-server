<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        foreach (Customer::all() as $customer) {
            $contactsCount = rand(1, 3);
            for ($i = 0; $i < $contactsCount; $i++) {
                Contact::create([
                    'contactable_id' => $customer->id,
                    'contactable_type' => Customer::class,
                    'type' => $faker->randomElement(['email', 'phone']),
                    'value' => $faker->randomElement([
                        $faker->unique()->safeEmail(),
                        '+380' . $faker->numerify('#########')
                    ]),
                ]);
            }
        }
    }
}
