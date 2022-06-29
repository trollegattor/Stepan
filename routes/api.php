<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
//Route::post('/register', [AuthController::class,'register']);

Route::prefix('/sanctum')->group(function() {
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResources(['category' => CategoryController::class]);
    Route::apiResources(['article' => ArticleController::class,]);
    Route::apiResources(['menu' => MenuController::class,]);
    Route::apiResources(['user' => UserController::class,]);
    Route::apiResources(['role' => RoleController::class,]);
});




/*
Route::apiResources(['category' => CategoryController::class]);
Route::apiResources(['article' => ArticleController::class,]);
Route::apiResources(['menu' => MenuController::class,]);
*/

