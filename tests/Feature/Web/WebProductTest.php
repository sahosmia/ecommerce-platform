<?php

namespace Tests\Feature\Web;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_products_organized_by_subcategories_on_home_page()
    {
        $category = Category::factory()->create(['name' => 'Tech']);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'Laptops',
        ]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Super Gaming Laptop',
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Laptops');
        $response->assertSee('Super Gaming Laptop');
    }

    /** @test */
    public function it_can_display_single_product_details_by_slug()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Ultra HD 4K Monitor',
            'slug' => 'ultra-hd-4k-monitor',
        ]);

        $response = $this->get(route('product.details', $product->slug));

        $response->assertStatus(200);
        $response->assertSee('Ultra HD 4K Monitor');
    }

    /** @test */
    public function it_can_display_products_under_specific_subcategory()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'Smartphones',
            'slug' => 'smartphones',
        ]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Pixel Phone',
        ]);

        $response = $this->get(route('subcategory.products', $subcategory->slug));

        $response->assertStatus(200);
        $response->assertSee('Pixel Phone');
    }

    /** @test */
    public function it_can_display_category_products_via_unified_categories_route()
    {
        $category = Category::factory()->create([
            'name' => 'Fashion & Apparel',
            'slug' => 'fashion-apparel',
        ]);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'Shoes',
            'slug' => 'shoes',
        ]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Leather Boots',
        ]);

        $response = $this->get(route('categories.view', $category->slug));

        $response->assertStatus(200);
        $response->assertSee('Fashion & Apparel');
        $response->assertSee('Leather Boots');
    }

    /** @test */
    public function it_can_display_subcategory_products_via_unified_categories_route()
    {
        $category = Category::factory()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
        ]);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'Tablets',
            'slug' => 'tablets',
        ]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'iPad Pro',
        ]);

        $response = $this->get(route('categories.view', [$category->slug, $subcategory->slug]));

        $response->assertStatus(200);
        $response->assertSee('Tablets');
        $response->assertSee('iPad Pro');
    }
}
