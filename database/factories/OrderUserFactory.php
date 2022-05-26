<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->randomElement(Order::pluck('id')->toArray()),
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray())
        ];
    }
}
