<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
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

// Меню редактирования товаров
Route::get('/add', [ProductsController::class, 'add']);

// Добавление товара
Route::post('/addProd', [ProductsController::class, 'addProd']);

// Удаление товара
Route::delete('/{product}', [ProductsController::class, 'destroy']);

// Форма для импорта csv
Route::get('/importForm', [ProductsController::class, 'importForm']);

// Импорт csv
Route::post('/import', [ProductsController::class, 'import']);

// Форма для экспорта CSV
Route::get('/exportForm', [ProductsController::class, 'exportForm']);

// Экспорт CSV
Route::get('/export', [ProductsController::class, 'export']);

// Показать форму заявки
Route::get('/order/{product}', [OrdersController::class, 'create']);

// Создать новую заявку
Route::post('/user/{product}', [OrdersController::class, 'store']);

// Показать список заявок
Route::get('/showOrder', [OrdersController::class, 'showOrder']);

// Форма для регистрации нового работника
Route::get('/create', [UserController::class, 'create']);

// Регистрация и вход нового работника
Route::post('/users', [UserController::class, 'store']);

// Выход из акаунта работника
Route::post('/logout', [UserController::class, 'logout']);

// Форма авторизации работника
Route::get('/login', [UserController::class, 'login']);

// Авторизация работника
Route::post('/users/authenticate', [UserController::class, 'authenticate']);