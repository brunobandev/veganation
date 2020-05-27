<?php

Auth::routes();

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('/recipes/categories', 'CategoriesController@index')->name('recipes.categories');
Route::get('/recipes/categories/{category}', 'CategoriesController@show')->name('recipes.categories.show');
Route::get('/recipes/{id}', 'RecipesController@show')->name('recipes.show');
Route::get('/recipes', 'RecipesController@index')->name('recipes.index');
Route::get('/', 'HomeController@index');

Route::namespace('Settings')->prefix('settings')->name('settings.')->middleware(['auth'])->group(function () {
    Route::resource('recipes', 'RecipesController');
    Route::get('recipes/favorites', 'RecipesController@favorites')->name('recipes.favorites');
});
