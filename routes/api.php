<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
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

});



/*
Route::apiResources(['category' => CategoryController::class]);
Route::apiResources(['article' => ArticleController::class,]);
Route::apiResources(['menu' => MenuController::class,]);
*/

