<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_pesanan' => 'KP'.$this->faker->randomAscii(),
            'tanggal' => now(),
            'status' => $this->faker->boolean(),
            'total' => $this->faker->numberBetween(100_000, 1000_000),
            'no_antrian' => $this->faker->randomDigitNotZero(),
        ];
    }
}
