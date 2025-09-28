<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');
        $subcategories = Subcategory::all()->keyBy('name');

        $productsData = [
            [
                'name' => 'Smartphone Pro X', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Smartphones']->id,
                'description' => 'The latest smartphone with a stunning display and pro-grade camera system.', 'image' => 'electronics/smartphone_pro_x.jpg', 'price' => 99999.00,
                'discount_type' => 'percentage', 'discount_value' => 10.00,
            ],
            [
                'name' => 'Ultra-Thin Laptop', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Laptops']->id,
                'description' => 'A sleek and powerful laptop for professionals on the go.', 'image' => 'electronics/laptop_ultra_thin.jpg', 'price' => 120000.00,
                'discount_type' => 'fixed', 'discount_value' => 5000.00,
            ],
            [
                'name' => 'Noise-Cancelling Headphones', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Headphones']->id,
                'description' => 'Immerse yourself in music with these top-tier headphones.', 'image' => 'electronics/headphones_noise_cancelling.jpg', 'price' => 25000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => '4K Action Camera', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Cameras']->id,
                'description' => 'Capture your adventures in stunning 4K resolution.', 'image' => 'electronics/camera_4k_action.jpg', 'price' => 45000.00,
                'discount_type' => 'percentage', 'discount_value' => 15.00,
            ],
            [
                'name' => 'Budget Smartphone', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Smartphones']->id,
                'description' => 'A reliable smartphone with all the essential features.', 'image' => 'electronics/smartphone_budget.jpg', 'price' => 20000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Gaming Laptop', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Laptops']->id,
                'description' => 'Dominate the competition with this high-performance gaming laptop.', 'image' => 'electronics/laptop_gaming.jpg', 'price' => 180000.00,
                'discount_type' => 'fixed', 'discount_value' => 10000.00,
            ],
            [
                'name' => 'Wireless Earbuds', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Headphones']->id,
                'description' => 'Enjoy true freedom with these comfortable and long-lasting wireless earbuds.', 'image' => 'electronics/earbuds_wireless.jpg', 'price' => 15000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Mirrorless Camera', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Cameras']->id,
                'description' => 'A versatile mirrorless camera for enthusiasts and professionals alike.', 'image' => 'electronics/camera_mirrorless.jpg', 'price' => 85000.00,
                'discount_type' => 'percentage', 'discount_value' => 10.00,
            ],
            [
                'name' => 'Smartwatch', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Accessories']->id,
                'description' => 'Stay connected and track your fitness with this stylish smartwatch.', 'image' => 'electronics/smartwatch.jpg', 'price' => 30000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Portable Projector', 'category_id' => $categories['Electronics']->id, 'subcategory_id' => $subcategories['Cameras']->id,
                'description' => 'Turn any space into a home theater with this compact and bright projector.', 'image' => 'electronics/projector_portable.jpg', 'price' => 55000.00,
                'discount_type' => 'fixed', 'discount_value' => 2500.00,
            ],

            // Clothing & Fashion (10)
            [
                'name' => 'Men\'s Classic T-Shirt', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Men\'s Wear']->id,
                'description' => 'A timeless and comfortable t-shirt made from premium cotton.', 'image' => 'clothing/men_tshirt_classic.jpg', 'price' => 2500.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Women\'s Summer Dress', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Women\'s Wear']->id,
                'description' => 'A light and airy dress perfect for warm summer days.', 'image' => 'clothing/women_dress_summer.jpg', 'price' => 4500.00,
                'discount_type' => 'percentage', 'discount_value' => 20.00,
            ],
            [
                'name' => 'Leather Belt', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Accessories']->id,
                'description' => 'A stylish and durable leather belt that complements any outfit.', 'image' => 'clothing/accessory_leather_belt.jpg', 'price' => 3500.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Running Shoes', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Footwear']->id,
                'description' => 'Experience ultimate comfort and support on your runs.', 'image' => 'clothing/footwear_running_shoes.jpg', 'price' => 8000.00,
                'discount_type' => 'fixed', 'discount_value' => 500.00,
            ],
            [
                'name' => 'Men\'s Slim-Fit Jeans', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Men\'s Wear']->id,
                'description' => 'Modern and stylish slim-fit jeans for a sharp look.', 'image' => 'clothing/men_jeans_slimfit.jpg', 'price' => 6000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Women\'s Blouse', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Women\'s Wear']->id,
                'description' => 'An elegant blouse perfect for both casual and formal occasions.', 'image' => 'clothing/women_blouse.jpg', 'price' => 3800.00,
                'discount_type' => 'percentage', 'discount_value' => 10.00,
            ],
            [
                'name' => 'Designer Sunglasses', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Accessories']->id,
                'description' => 'Protect your eyes in style with these designer sunglasses.', 'image' => 'clothing/accessory_sunglasses.jpg', 'price' => 12000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Ankle Boots', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Footwear']->id,
                'description' => 'Versatile and fashionable ankle boots for any season.', 'image' => 'clothing/footwear_ankle_boots.jpg', 'price' => 7500.00,
                'discount_type' => 'fixed', 'discount_value' => 1000.00,
            ],
            [
                'name' => 'Men\'s Formal Shirt', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Men\'s Wear']->id,
                'description' => 'A crisp and professional formal shirt for the modern man.', 'image' => 'clothing/men_shirt_formal.jpg', 'price' => 4200.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Women\'s Handbag', 'category_id' => $categories['Clothing & Fashion']->id, 'subcategory_id' => $subcategories['Accessories']->id,
                'description' => 'A chic and spacious handbag to carry your essentials.', 'image' => 'clothing/women_handbag.jpg', 'price' => 9000.00,
                'discount_type' => 'percentage', 'discount_value' => 15.00,
            ],

            // Home & Kitchen (10)
            [
                'name' => 'Non-Stick Cookware Set', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Cookware']->id,
                'description' => 'A complete set of non-stick cookware for all your cooking needs.', 'image' => 'home/cookware_set.jpg', 'price' => 12000.00,
                'discount_type' => 'fixed', 'discount_value' => 1500.00,
            ],
            [
                'name' => 'Modern Sofa', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Furniture']->id,
                'description' => 'A comfortable and stylish sofa to enhance your living room.', 'image' => 'home/furniture_sofa.jpg', 'price' => 60000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'High-Speed Blender', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Small Appliances']->id,
                'description' => 'Create delicious smoothies and more with this powerful blender.', 'image' => 'home/appliance_blender.jpg', 'price' => 18000.00,
                'discount_type' => 'percentage', 'discount_value' => 10.00,
            ],
            [
                'name' => 'Decorative Wall Mirror', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Home Decor']->id,
                'description' => 'Add a touch of elegance to your home with this beautiful wall mirror.', 'image' => 'home/decor_mirror.jpg', 'price' => 5000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Cast Iron Skillet', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Cookware']->id,
                'description' => 'A durable and versatile cast iron skillet for perfect searing.', 'image' => 'home/cookware_skillet.jpg', 'price' => 4000.00,
                'discount_type' => 'fixed', 'discount_value' => 200.00,
            ],
            [
                'name' => 'Dining Table Set', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Furniture']->id,
                'description' => 'A beautiful dining table set for family meals and gatherings.', 'image' => 'home/furniture_dining_table.jpg', 'price' => 80000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Air Fryer', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Small Appliances']->id,
                'description' => 'Enjoy your favorite fried foods with less oil.', 'image' => 'home/appliance_air_fryer.jpg', 'price' => 15000.00,
                'discount_type' => 'percentage', 'discount_value' => 20.00,
            ],
            [
                'name' => 'Scented Candles Set', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Home Decor']->id,
                'description' => 'Create a relaxing ambiance with this set of scented candles.', 'image' => 'home/decor_candles.jpg', 'price' => 3000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Espresso Machine', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Small Appliances']->id,
                'description' => 'Brew barista-quality espresso at home.', 'image' => 'home/appliance_espresso_machine.jpg', 'price' => 28000.00,
                'discount_type' => 'fixed', 'discount_value' => 1000.00,
            ],
            [
                'name' => 'Bookshelf', 'category_id' => $categories['Home & Kitchen']->id, 'subcategory_id' => $subcategories['Furniture']->id,
                'description' => 'A stylish and functional bookshelf to display your favorite reads.', 'image' => 'home/furniture_bookshelf.jpg', 'price' => 12000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],

            // Sports & Outdoors (10)
            [
                'name' => 'Yoga Mat', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Fitness Equipment']->id,
                'description' => 'A comfortable and non-slip yoga mat for your practice.', 'image' => 'sports/fitness_yoga_mat.jpg', 'price' => 3000.00,
                'discount_type' => 'percentage', 'discount_value' => 10.00,
            ],
            [
                'name' => 'Camping Tent', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Camping Gear']->id,
                'description' => 'A durable and waterproof tent for your outdoor adventures.', 'image' => 'sports/camping_tent.jpg', 'price' => 15000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Moisture-Wicking T-Shirt', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Athletic Apparel']->id,
                'description' => 'Stay cool and dry during your workouts with this high-performance t-shirt.', 'image' => 'sports/apparel_tshirt.jpg', 'price' => 3500.00,
                'discount_type' => 'fixed', 'discount_value' => 300.00,
            ],
            [
                'name' => 'Mountain Bike', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Cycling']->id,
                'description' => 'Conquer any trail with this rugged and reliable mountain bike.', 'image' => 'sports/cycling_mountain_bike.jpg', 'price' => 50000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Adjustable Dumbbells', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Fitness Equipment']->id,
                'description' => 'A space-saving and versatile set of adjustable dumbbells.', 'image' => 'sports/fitness_dumbbells.jpg', 'price' => 25000.00,
                'discount_type' => 'percentage', 'discount_value' => 15.00,
            ],
            [
                'name' => 'Hiking Backpack', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Camping Gear']->id,
                'description' => 'A comfortable and spacious backpack for all your hiking essentials.', 'image' => 'sports/camping_backpack.jpg', 'price' => 9000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Athletic Shorts', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Athletic Apparel']->id,
                'description' => 'Lightweight and breathable shorts for maximum performance.', 'image' => 'sports/apparel_shorts.jpg', 'price' => 2800.00,
                'discount_type' => 'fixed', 'discount_value' => 150.00,
            ],
            [
                'name' => 'Road Bike', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Cycling']->id,
                'description' => 'A fast and efficient road bike for serious cyclists.', 'image' => 'sports/cycling_road_bike.jpg', 'price' => 75000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Treadmill', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Fitness Equipment']->id,
                'description' => 'A high-quality treadmill for effective cardio workouts at home.', 'image' => 'sports/fitness_treadmill.jpg', 'price' => 120000.00,
                'discount_type' => 'fixed', 'discount_value' => 5000.00,
            ],
            [
                'name' => 'Sleeping Bag', 'category_id' => $categories['Sports & Outdoors']->id, 'subcategory_id' => $subcategories['Camping Gear']->id,
                'description' => 'Stay warm and comfortable on your camping trips with this premium sleeping bag.', 'image' => 'sports/camping_sleeping_bag.jpg', 'price' => 8000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],

            // Books & Media (10)
            [
                'name' => 'The Alchemist', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Fiction']->id,
                'description' => 'A classic novel about following your dreams, by Paulo Coelho.', 'image' => 'books/fiction_alchemist.jpg', 'price' => 1200.00,
                'discount_type' => 'percentage', 'discount_value' => 10.00,
            ],
            [
                'name' => 'Sapiens: A Brief History of Humankind', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Non-Fiction']->id,
                'description' => 'A captivating look at the history of our species, by Yuval Noah Harari.', 'image' => 'books/nonfiction_sapiens.jpg', 'price' => 1500.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'Watchmen', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Comics']->id,
                'description' => 'The groundbreaking graphic novel by Alan Moore and Dave Gibbons.', 'image' => 'books/comics_watchmen.jpg', 'price' => 2500.00,
                'discount_type' => 'fixed', 'discount_value' => 200.00,
            ],
            [
                'name' => 'The Godfather Trilogy (Blu-ray)', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Music & Movies']->id,
                'description' => 'The iconic film series, beautifully restored on Blu-ray.', 'image' => 'books/movies_godfather.jpg', 'price' => 4000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'To Kill a Mockingbird', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Fiction']->id,
                'description' => 'A timeless American classic by Harper Lee.', 'image' => 'books/fiction_mockingbird.jpg', 'price' => 1100.00,
                'discount_type' => 'percentage', 'discount_value' => 5.00,
            ],
            [
                'name' => 'Educated: A Memoir', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Non-Fiction']->id,
                'description' => 'The powerful and inspiring memoir by Tara Westover.', 'image' => 'books/nonfiction_educated.jpg', 'price' => 1400.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => 'The Sandman: Vol. 1', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Comics']->id,
                'description' => 'The beginning of Neil Gaiman\'s epic fantasy series.', 'image' => 'books/comics_sandman.jpg', 'price' => 2200.00,
                'discount_type' => 'fixed', 'discount_value' => 150.00,
            ],
            [
                'name' => 'Abbey Road (Vinyl)', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Music & Movies']->id,
                'description' => 'The Beatles\' legendary album, pressed on high-quality vinyl.', 'image' => 'books/music_abbey_road.jpg', 'price' => 3800.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
            [
                'name' => '1984', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Fiction']->id,
                'description' => 'George Orwell\'s dystopian masterpiece.', 'image' => 'books/fiction_1984.jpg', 'price' => 950.00,
                'discount_type' => 'percentage', 'discount_value' => 10.00,
            ],
            [
                'name' => 'Pulp Fiction (Blu-ray)', 'category_id' => $categories['Books & Media']->id, 'subcategory_id' => $subcategories['Music & Movies']->id,
                'description' => 'Quentin Tarantino\'s cinematic classic, now on Blu-ray.', 'image' => 'books/movies_pulp_fiction.jpg', 'price' => 2000.00,
                'discount_type' => 'fixed', 'discount_value' => 0,
            ],
        ];

        foreach ($productsData as $data) {
            Product::create(array_merge($data, [
                'slug' => Str::slug($data['name']),
            ]));
        }
    }
}
