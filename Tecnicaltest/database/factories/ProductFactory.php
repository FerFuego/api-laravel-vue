<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => Str::random(5),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'photo' => $this->faker->image('public/storage/images', 400, 300, null, false),
        ];
    }
}
