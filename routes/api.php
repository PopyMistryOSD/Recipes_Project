<?php

use App\Http\Controllers\Api\RecipeApiController;
use Illuminate\Support\Facades\Route;

Route::get('/check_connection', [RecipeApiController::class, 'checkConnection']);

Route::middleware('api.key')->group(function () {
    Route::get('/get_home', [RecipeApiController::class, 'home']);
    Route::get('/get_recent_recipes', [RecipeApiController::class, 'recentRecipes']);
    Route::get('/get_recipe_detail', [RecipeApiController::class, 'recipeDetail']);
    Route::get('/get_category_index', [RecipeApiController::class, 'categoryIndex']);
    Route::get('/get_category_posts', [RecipeApiController::class, 'categoryPosts']);
    Route::get('/get_search_results', [RecipeApiController::class, 'searchResults']);
    Route::get('/get_ads', [RecipeApiController::class, 'ads']);
    Route::get('/get_settings', [RecipeApiController::class, 'settings']);
    Route::get('/get_config', [RecipeApiController::class, 'config']);
});

Route::get('/get_total_views', [RecipeApiController::class, 'totalViews']);
Route::get('/get_user_token', [RecipeApiController::class, 'userToken']);
