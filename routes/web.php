<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

// Показывает все продукты
Route::get('/', [ProductsController::class, 'index']);

// Показать форму заявки
Route::get('/order/{product}', [OrdersController::class, 'create']);

// Создать новую заявку
Route::post('/user/{product}', [OrdersController::class, 'store']);

// Форма для импорта csv
Route::get('/importForm', [ProductsController::class, 'importForm']);

// Импорт csv
Route::post('/import', [ProductsController::class, 'import']);