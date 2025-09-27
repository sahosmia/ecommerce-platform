<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $electronicsId = Category::where('name', 'Electronics')->first()->id ?? 1;
        $smartphonesId = Subcategory::where('name', 'Smartphones')->first()->id ?? 1;
        $laptopsId = Subcategory::where('name', 'Laptops')->first()->id ?? 2;

        $clothingId = Category::where('name', 'Clothing & Fashion')->first()->id ?? 2;
        $menswearId = Subcategory::where('name', 'Men\'s Wear')->first()->id ?? 4;


        $productsData = [
            // ইলেকট্রনিক্স পণ্য
            [
                'name' => 'Flagship Smartphone X',
                'category_id' => $electronicsId,
                'subcategory_id' => $smartphonesId,
                'description' => 'A powerful flagship smartphone with an amazing camera and battery life.',
                'image' => 'flagship-phone.jpg',
                'price' => 79999.00,
                'discount_type' => 'percentage',
                'discount_value' => 10.00,
            ],
            [
                'name' => 'Ultra-Thin Laptop Pro',
                'category_id' => $electronicsId,
                'subcategory_id' => $laptopsId,
                'description' => 'Sleek design with high-speed performance for professionals.',
                'image' => 'laptop-pro.jpg',
                'price' => 125000.00,
                'discount_type' => 'fixed',
                'discount_value' => 5000.00,
            ],
            [
                'name' => 'Premium Cotton T-Shirt',
                'category_id' => $clothingId,
                'subcategory_id' => $menswearId,
                'description' => '100% breathable cotton t-shirt, perfect for summer.',
                'image' => 'tshirt-premium.jpg',
                'price' => 1500.00,
                'discount_type' => 'percentage',
                'discount_value' => 0.00,
            ],
        ];

        foreach ($productsData as $data) {
            Product::create(array_merge($data, [
                'slug' => Str::slug($data['name']),
            ]));
        }
    }
}
