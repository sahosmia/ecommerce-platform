<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryMap = [
            'Electronics' => ['Smartphones', 'Laptops', 'Headphones', 'Cameras'],
            'Clothing & Fashion' => ['Men\'s Wear', 'Women\'s Wear', 'Accessories', 'Footwear'],
            'Home & Kitchen' => ['Cookware', 'Furniture', 'Small Appliances', 'Home Decor'],
            'Sports & Outdoors' => ['Fitness Equipment', 'Camping Gear', 'Athletic Apparel', 'Cycling'],
            'Books & Media' => ['Fiction', 'Non-Fiction', 'Comics', 'Music & Movies'],
        ];

        foreach ($categoryMap as $categoryName => $subcategories) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) continue;

            foreach ($subcategories as $subName) {
                Subcategory::create([
                    'category_id' => $category->id,
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                ]);
            }
        }
    }
}
