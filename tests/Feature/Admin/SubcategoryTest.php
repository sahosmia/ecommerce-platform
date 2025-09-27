<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubcategoryTest extends TestCase
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
    public function it_can_display_the_subcategory_index_page()
    {
        Subcategory::factory()->count(3)->create();

        $response = $this->get(route('admin.subcategories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.subcategories.index');
        $response->assertSee(Subcategory::first()->name);
    }

    /** @test */
    public function it_can_display_the_subcategory_create_page()
    {
        $response = $this->get(route('admin.subcategories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.subcategories.create');
    }

    /** @test */
    public function it_can_store_a_new_subcategory()
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'New Subcategory',
            'category_id' => $category->id,
        ];

        $response = $this->post(route('admin.subcategories.store'), $data);

        $response->assertRedirect(route('admin.subcategories.index'));
        $response->assertSessionHas('success', 'Subcategory created successfully.');
        $this->assertDatabaseHas('subcategories', ['name' => 'New Subcategory']);
    }

    /** @test */
    public function it_can_display_the_subcategory_edit_page()
    {
        $subcategory = Subcategory::factory()->create();

        $response = $this->get(route('admin.subcategories.edit', $subcategory));

        $response->assertStatus(200);
        $response->assertViewIs('admin.subcategories.edit');
        $response->assertSee($subcategory->name);
    }

    /** @test */
    public function it_can_update_a_subcategory()
    {
        $subcategory = Subcategory::factory()->create();
        $category = Category::factory()->create();
        $data = [
            'name' => 'Updated Subcategory',
            'category_id' => $category->id,
        ];

        $response = $this->put(route('admin.subcategories.update', $subcategory), $data);

        $response->assertRedirect(route('admin.subcategories.index'));
        $response->assertSessionHas('success', 'Subcategory updated successfully.');
        $this->assertDatabaseHas('subcategories', ['id' => $subcategory->id, 'name' => 'Updated Subcategory']);
    }

    /** @test */
    public function it_can_soft_delete_a_subcategory()
    {
        $subcategory = Subcategory::factory()->create();

        $response = $this->delete(route('admin.subcategories.destroy', $subcategory));

        $response->assertRedirect(route('admin.subcategories.index'));
        $response->assertSessionHas('success', 'Subcategory soft-deleted successfully.');
        $this->assertSoftDeleted('subcategories', ['id' => $subcategory->id]);
    }

    /** @test */
    public function it_can_display_the_subcategory_trash_page()
    {
        Subcategory::factory()->create()->delete(); // Create a soft-deleted subcategory

        $response = $this->get(route('admin.subcategories.trash'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.subcategories.trash');
    }

    /** @test */
    public function it_can_restore_a_soft_deleted_subcategory()
    {
        $subcategory = Subcategory::factory()->create();
        $subcategory->delete();

        $response = $this->post(route('admin.subcategories.restore', $subcategory->id));

        $response->assertRedirect(route('admin.subcategories.index'));
        $response->assertSessionHas('success', 'Subcategory restored successfully.');
        $this->assertNotSoftDeleted('subcategories', ['id' => $subcategory->id]);
    }

    /** @test */
    public function it_can_permanently_delete_a_subcategory()
    {
        $subcategory = Subcategory::factory()->create();
        $subcategory->delete();

        $response = $this->delete(route('admin.subcategories.force-delete', $subcategory->id));

        $response->assertRedirect(route('admin.subcategories.trash'));
        $response->assertSessionHas('success', 'Subcategory permanently deleted.');
        $this->assertDatabaseMissing('subcategories', ['id' => $subcategory->id]);
    }
}