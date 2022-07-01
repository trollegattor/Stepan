<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/sanctum')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('category', CategoryController::class)
        ->except(['index', 'show']);
    Route::resource('article', ArticleController::class)
        ->except(['index', 'show']);
    Route::resource('menu', MenuController::class,)
        ->except(['index', 'show']);
    Route::apiResources(['user' => UserController::class,]);
    Route::apiResources(['role' => RoleController::class,]);
});
Route::resource('category', CategoryController::class)
    ->only(['index', 'show']);
Route::resource('article', ArticleController::class)
    ->only(['index', 'show']);
Route::resource('menu', MenuController::class,)
    ->only(['index', 'show']);


