<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and act as that user for all tests in this class
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function it_can_display_the_category_index_page()
    {
        Category::factory()->count(3)->create();

        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.index');
        $response->assertSee(Category::first()->name);
    }

    /** @test */
    public function it_can_display_the_category_create_page()
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.create');
    }

    /** @test */
    public function it_can_store_a_new_category()
    {
        $data = [
            'name' => 'New Category',
        ];

        $response = $this->post(route('admin.categories.store'), $data);

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success', 'Category created successfully.');
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
    }

    /** @test */
    public function it_can_display_the_category_edit_page()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('admin.categories.edit', $category));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.edit');
        $response->assertSee($category->name);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'Updated Category',
        ];

        $response = $this->put(route('admin.categories.update', $category), $data);

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success', 'Category updated successfully.');
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Category']);
    }

    /** @test */
    public function it_can_soft_delete_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success', 'Category soft-deleted successfully.');
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    /** @test */
    public function it_can_display_the_trash_page()
    {
        Category::factory()->create()->delete(); // Create a soft-deleted category

        $response = $this->get(route('admin.categories.trash'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.trash');
    }

    /** @test */
    public function it_can_restore_a_soft_deleted_category()
    {
        $category = Category::factory()->create();
        $category->delete();

        $response = $this->post(route('admin.categories.restore', $category->id));

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success', 'Category restored successfully.');
        $this->assertNotSoftDeleted('categories', ['id' => $category->id]);
    }

    /** @test */
    public function it_can_permanently_delete_a_category()
    {
        $category = Category::factory()->create();
        $category->delete();

        $response = $this->delete(route('admin.categories.force-delete', $category->id));

        $response->assertRedirect(route('admin.categories.trash'));
        $response->assertSessionHas('success', 'Category permanently deleted.');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}