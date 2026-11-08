<?php

namespace Tests\Feature\Web;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


use PHPUnit\Framework\Attributes\Test;

class WebProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
    public function it_can_render_product_details_when_category_or_subcategory_is_soft_deleted()
    {
        $category = Category::factory()->create(['name' => 'Main Category']);
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id, 'name' => 'Main Subcategory']);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Orphaned Product',
            'slug' => 'orphaned-product',
        ]);

        // Soft delete the category
        $category->delete();

        $response = $this->get(route('product.details', $product->slug));

        $response->assertStatus(200);
        $response->assertSee('Orphaned Product');
    }
}
