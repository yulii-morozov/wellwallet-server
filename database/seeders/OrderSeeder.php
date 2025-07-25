<?php

namespace Database\Seeders;

use App\Enums\OrderSource;
use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $userIds = User::pluck('id')->toArray();
        $customerIds = Customer::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            Order::create([
                'creator_id' => $faker->randomElement($userIds),
                'customer_id' => $faker->randomElement($customerIds),
                'type' => $faker->randomElement([OrderType::PURCHASE, OrderType::SALE]),
                'source' => $faker->randomElement([OrderSource::WEB, OrderSource::TELEGRAM]),
                'status' => $faker->randomElement([OrderStatus::CREATED, OrderStatus::IN_PROGRESS, OrderStatus::CLOSED]),
            ]);
        }
    }
}