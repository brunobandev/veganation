<?php

namespace Tests\Feature\Settings;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\User;
use App\Category;

class CategoriesController extends TestCase
{
    use RefreshDatabase;

    public $user;

    private function createUser($is_admin = 0)
    {
        $this->user = factory(User::class)->create([
            'provider' => 'facebook',
            'provider_id' => '09830293820',
            'is_admin' => $is_admin
        ]);
    }

    public function test_non_admin_cannot_see_settings_categories_page()
    {
        $this->createUser();
        $response = $this->actingAs($this->user)->get('/settings/categories');
        $response->assertStatus(403);
    }

    public function test_admin_can_see_settings_categories_page()
    {
        $this->createUser(1);
        $response = $this->ActingAs($this->user)->get('/settings/categories');
        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_see_settings_categories_create_page()
    {
        $this->createUser();
        $response = $this->actingAs($this->user)->get('/settings/categories/create');

        $response->assertStatus(403);
    }

    public function test_admin_can_see_settings_categories_create_page()
    {
        $this->createUser(1);
        $response = $this->ActingAs($this->user)->get('/settings/categories/create');
        $response->assertStatus(200);
    }

    public function test_store_category_exists_in_database()
    {
        $this->createUser(1);
        $response = $this->ActingAs($this->user)->post('settings/categories', [
            'name' => 'Bebidas',
            'slug' => Str::slug('bebidas'),
        ]);

        $this->assertDatabaseHas('categories', ['name' => 'Bebidas']);
        $response->assertRedirect(route('settings.categories.index'));

        $category = Category::orderBy('id', 'desc')->first();
        $this->assertEquals('Bebidas', $category->name);
    }

    public function test_update_category_correct_validation_error()
    {
        $this->createUser(1);
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->user)->put('/settings/categories/' . $category->id, [
            'name' => 'Test'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_update_category_correct()
    {
        $this->createUser(1);
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->user)->put('/settings/categories/' . $category->id, [
            'name' => 'Categoria'
        ]);

        $this->assertDatabaseHas('categories', ['name' => 'Categoria']);
        $response->assertStatus(302);
    }

    public function test_delete_category_no_longer_exists_in_database()
    {
        $this->createUser(1);
        $category = factory(Category::class)->create();

        $this->assertEquals(1, Category::count());

        $response = $this->actingAs($this->user)->delete('/settings/categories/' . $category->id);

        $response->assertRedirect(route('settings.categories.index'));
        $response->assertStatus(302);
        $this->assertEquals(0, Category::count());
    }
}
