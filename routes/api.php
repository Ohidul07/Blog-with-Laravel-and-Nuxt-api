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

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']); 
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user'])->middleware('auth:sanctum');  
    Route::get('verify-email', [\App\Http\Controllers\AuthController::class, 'verifyEmail'])
        ->name('verification.verify'); 
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('categories', [\App\Http\Controllers\Admin\CategoriesController::class, 'index'])->middleware('auth:sanctum'); 
    Route::post('categories/create', [\App\Http\Controllers\Admin\CategoriesController::class, 'store'])->middleware('auth:sanctum');
    Route::get('categories/edit/{id}', [\App\Http\Controllers\Admin\CategoriesController::class, 'edit'])->middleware('auth:sanctum');
    Route::put('categories/{id}', [\App\Http\Controllers\Admin\CategoriesController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('categories/{id}', [\App\Http\Controllers\Admin\CategoriesController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('tags', [\App\Http\Controllers\Admin\TagsController::class, 'index'])->middleware('auth:sanctum'); 
    Route::post('tags/create', [\App\Http\Controllers\Admin\TagsController::class, 'store'])->middleware('auth:sanctum');
    Route::get('tags/edit/{id}', [\App\Http\Controllers\Admin\TagsController::class, 'edit'])->middleware('auth:sanctum');
    Route::put('tags/{id}', [\App\Http\Controllers\Admin\TagsController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('tags/{id}', [\App\Http\Controllers\Admin\TagsController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('posts', [\App\Http\Controllers\Admin\PostsController::class, 'index'])->middleware('auth:sanctum'); 
    Route::post('posts/create', [\App\Http\Controllers\Admin\PostsController::class, 'store'])->middleware('auth:sanctum');
    Route::get('posts/edit/{id}', [\App\Http\Controllers\Admin\PostsController::class, 'edit'])->middleware('auth:sanctum');
    Route::put('posts/{id}', [\App\Http\Controllers\Admin\PostsController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('posts/{id}', [\App\Http\Controllers\Admin\PostsController::class, 'destroy'])->middleware('auth:sanctum');
});
