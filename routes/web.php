<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ExportController;
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

Route::get('/', function () {
    return view('welcome');
});

// Показывает все продукты
// Route::get('/welcome', [ProductsController::class, 'index']);

// Меню редактирования товаров
Route::get('/add', [ProductsController::class, 'add']);

// Добавление товара
Route::post('/addProd', [ProductsController::class, 'addProd']);

// Удаление товара
Route::delete('/{product}', [ProductsController::class, 'destroy']);

// Просмотр категорий товаров
Route::get('/categories', [CategoriesController::class, 'index']);

// Форма редактирования категорий
Route::get('/category/{products}/edit', [ProductsController::class, 'category']);

// Изменение категорий
Route::put('/category/{products}', [ProductsController::class, 'change']);

// Форма для импорта csv
Route::get('/importForm', [ImportController::class, 'importForm']);

// Импорт csv
Route::post('/import', [ImportController::class, 'import']);

// Форма для экспорта CSV
Route::get('/exportForm', [ExportController::class, 'exportForm']);

// Экспорт CSV
Route::get('/export', [ExportController::class, 'export']);

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