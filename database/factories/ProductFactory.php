<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        return [
            'category_id' => function () {
                return Category::factory()->create()->id;
            },
            'subcategory_id' => function (array $attributes) {
                return Subcategory::factory()->create(['category_id' => $attributes['category_id']])->id;
            },
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'image' => null,
            'price' => fake()->randomFloat(2, 50, 1000),
            'discount_type' => fake()->randomElement(['fixed', 'percentage']),
            'discount_value' => fake()->randomFloat(2, 0, 20),
        ];
    }
}
