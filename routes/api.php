<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    // Route for user login
    Route::post('login', [\App\Http\Controllers\Api\AuthenticationController::class, 'store']);
    
    // Route for user logout (requires authentication)
    Route::post('logout', [\App\Http\Controllers\Api\AuthenticationController::class, 'destroy'])->middleware('auth:api');
    
    // Route for user registration
    Route::post('register', [\App\Http\Controllers\Api\AuthenticationController::class, 'saveNewUser']);
    Route::post('updateProfile', [\App\Http\Controllers\Api\ProfileController::class, 'updateProfile'])->middleware('auth:api');

    Route::post('Blog', [\App\Http\Controllers\Api\BlogController::class, 'store'])->middleware('auth:api');
    Route::post('get_product_brand', [\App\Http\Controllers\Api\ProductController::class, 'getProductBrand'])->middleware('auth:api');
    Route::post('get_brand', [\App\Http\Controllers\Api\ProductController::class, 'getBrand'])->middleware('auth:api');
    Route::get('getproductlist', [\App\Http\Controllers\Api\ProductController::class, 'getAllProductList']);
    Route::get('getallcat', [\App\Http\Controllers\Api\ProductController::class, 'getAllcat'])->middleware('auth:api');
    Route::get('getproductcat', [\App\Http\Controllers\Api\ProductController::class, 'getProductcat'])->middleware('auth:api');
    Route::get('getbloglist', [\App\Http\Controllers\Api\BlogController::class, 'getAllBlogList']);
    Route::post('getallCategory', [\App\Http\Controllers\Api\BlogController::class, 'getBlogByCategory']);
    Route::get('get_blog_categories', [\App\Http\Controllers\Api\BlogController::class, 'getAllBlogCategories']);
    Route::get('get_blog_details/{id}', [\App\Http\Controllers\Api\BlogController::class, 'getBlogDetails']);
    Route::get('search_blog', [\App\Http\Controllers\Api\BlogController::class, 'searchBlog']);
});
