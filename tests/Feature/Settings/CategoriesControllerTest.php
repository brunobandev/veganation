<?php

namespace Tests\Feature\Settings;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\{
    User,
    Category
};

class CategoriesController extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'provider' => 'facebook',
            'provider_id' => '09830293820'
        ]);
    }

    public function test_user_not_logged_cannot_see_settings_categories_page()
    {
        $response = $this->get('/settings/categories');
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    public function test_user_logged_can_see_settings_categories_page()
    {
        $response = $this->ActingAs($this->user)->get('/settings/categories');
        $response->assertStatus(200);
    }

    public function test_user_not_logged_cannot_see_settings_categories_create_page()
    {
        $response = $this->get('/settings/categories/create');

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    public function test_user_logged_can_see_settings_categories_create_page()
    {
        $response = $this->ActingAs($this->user)->get('/settings/categories/create');
        $response->assertStatus(200);
    }

    public function test_store_category_exists_in_database()
    {
        $response = $this->ActingAs($this->user)->post('settings/categories', [
            'name' => 'Bebidas'
        ]);

        $this->assertDatabaseHas('categories', ['name' => 'Bebidas']);
        $response->assertRedirect(route('settings.categories.index'));

        $category = Category::orderBy('id', 'desc')->first();
        $this->assertEquals('Bebidas', $category->name);
    }

    public function test_update_category_correct_validation_error()
    {
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->user)->put('/settings/categories/' . $category->id, [
            'name' => 'Test'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_update_category_correct()
    {
        $category = factory(Category::class)->create();

        $response = $this->actingAs($this->user)->put('/settings/categories/' . $category->id, [
            'name' => 'Categoria'
        ]);

        $this->assertDatabaseHas('categories', ['name' => 'Categoria']);
        $response->assertStatus(302);
    }

    public function test_delete_category_no_longer_exists_in_database()
    {
        $category = factory(Category::class)->create();

        $this->assertEquals(1, Category::count());

        $response = $this->actingAs($this->user)->delete('/settings/categories/' . $category->id);

        $response->assertRedirect(route('settings.categories.index'));
        $response->assertStatus(302);
        $this->assertEquals(0, Category::count());
    }
}
