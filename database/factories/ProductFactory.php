<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->words(2, true),
            'keterangan' => $this->faker->sentence(),
            'harga' => $this->faker->numberBetween(10_000, 100_000),
            'photo' => $this->faker->imageUrl(200, 200),
            'category_id' => $this->faker->randomElement(Category::pluck('id')->toArray())
        ];
    }
}
