<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function it_can_display_the_product_index_page()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);

        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.index');
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_can_display_the_product_create_page()
    {
        $response = $this->get(route('admin.products.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.create');
    }

    /** @test */
    public function it_can_store_a_new_product()
    {
        Storage::fake('public');

        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);

        $image = UploadedFile::fake()->image('product.jpg');

        $data = [
            'name' => 'Awesome Wireless Mouse',
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'description' => 'A great wireless mouse.',
            'price' => 50.00,
            'discount_type' => 'percentage',
            'discount_value' => 10.00,
            'image' => $image,
        ];

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success', 'Product created successfully.');

        $this->assertDatabaseHas('products', [
            'name' => 'Awesome Wireless Mouse',
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'price' => 50.00,
        ]);

        $product = Product::where('name', 'Awesome Wireless Mouse')->first();
        $this->assertNotNull($product->image);
        Storage::disk('public')->assertExists('products/' . $product->image);
    }

    /** @test */
    public function it_can_display_the_product_show_page()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);

        $response = $this->get(route('admin.products.show', $product));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.show');
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_can_display_the_product_edit_page()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);

        $response = $this->get(route('admin.products.edit', $product));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.edit');
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        Storage::fake('public');

        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Old Product Name',
        ]);

        $data = [
            'name' => 'Updated Product Name',
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'description' => 'Updated description',
            'price' => 75.00,
            'discount_type' => 'fixed',
            'discount_value' => 5.00,
        ];

        $response = $this->put(route('admin.products.update', $product), $data);

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success', 'Product updated successfully.');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'price' => 75.00,
        ]);
    }

    /** @test */
    public function it_can_soft_delete_a_product()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);

        $response = $this->delete(route('admin.products.destroy', $product));

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success', 'Product soft-deleted successfully.');
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    /** @test */
    public function it_can_display_the_product_trash_page()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);
        $product->delete();

        $response = $this->get(route('admin.products.trash'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.trash');
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_can_restore_a_soft_deleted_product()
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);
        $product->delete();

        $response = $this->post(route('admin.products.restore', $product->id));

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success', 'Product restored successfully.');
        $this->assertNotSoftDeleted('products', ['id' => $product->id]);
    }

    /** @test */
    public function it_can_permanently_delete_a_product()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');
        $stored = $image->store('products', 'public');
        $imageName = basename($stored);

        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'image' => $imageName,
        ]);
        $product->delete();

        $response = $this->delete(route('admin.products.force-delete', $product->id));

        $response->assertRedirect(route('admin.products.trash'));
        $response->assertSessionHas('success', 'Product permanently deleted.');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing('products/' . $imageName);
    }

    /** @test */
    public function it_fails_validation_if_subcategory_does_not_belong_to_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category2->id]);

        $data = [
            'name' => 'Mismatched Product',
            'category_id' => $category1->id,
            'subcategory_id' => $subcategory->id,
            'price' => 100,
            'discount_type' => 'fixed',
            'discount_value' => 0,
        ];

        $response = $this->post(route('admin.products.store'), $data);
        $response->assertSessionHasErrors('subcategory_id');
    }
}
