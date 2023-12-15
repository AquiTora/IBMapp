<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Группа роутов для манипуляций с продуктами
Route::group([
    'prefix' => 'products'
], function ($router) {
    // Отправляет все продукты
    Route::get('/', [ProductsController::class, 'index']);
    // Ищет продукты по названию
    Route::get('/search', [ProductsController::class, 'search']);
    // Удаляет продукты по нажатию на кнопочку
    Route::delete('/delete', [ProductsController::class, 'delete']);
});