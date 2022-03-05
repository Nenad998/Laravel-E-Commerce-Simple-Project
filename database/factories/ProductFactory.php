<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(2, true);
        $slug = Str::slug($name, '-');

        return [
            'name'=> $name,
            'slug'=> $slug,
            'description'=> $this->faker->sentence(),
            'price'=> $this->faker->numberBetween(10, 1000),
            'category_id'=> rand(1,4),
            'created_at'=> $this->faker->dateTime,
            'updated_at'=> now()
        ];
    }
}
