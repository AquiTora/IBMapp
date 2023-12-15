<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class ProductsController extends Controller
{
    // Определяет сколько товаров будет выводиться на одной странице
    private $itemsPerPage = 6;

    // Отправляет все продукты
    public function index(Request $request): JsonResponse
    {
        $page = $request->page;

        $data = $this->takePageProducts($page);
        
        return response()->json(['products' => $data['products'], 'total' => $data['totalItems']]);
    }

    // Тестовый вариант поиска
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['nullable']
        ]);

        $name = $validatedData['name'];

        $products = Products::where('name', 'like', "%{$name}%")->take($this->itemsPerPage)->get();

        $data = $this->takeCategory($products);

        return response()->json($data);
    }

    // Удаление товара по нажатию на кнопку
    public function delete(Request $request)
    {
        $deleteStatus = Products::where('id', '=', $request->id)->delete();

        $data = $this->takePageProducts($request->page);

        return response()->json([
            'status' => $deleteStatus, 
            'deleteItem' => $request->name,
            'products' => $data['products']
        ]);
    }

    // Берет товары на страницу
    private function takePageProducts($page)
    {
        $offset = ($page - 1) * $this->itemsPerPage;

        $takeProducts = Products::skip($offset)->take($this->itemsPerPage)->get();

        $products = $this->takeCategory($takeProducts);

        $totalItems = Products::count();

        $data = [
            'products' => $products,
            'totalItems' => $totalItems
        ];

        return $data;
    }

    // Прикрепляет категории к продуктам
    private function takeCategory($products)
    {
        $data = [];

        foreach ($products as $product)
        {
            $product['category_name'] = DB::table('categories')
                ->where('id', '=', $product['category_id'])
                ->get('name')[0]
                ->name;

            array_push($data, $product);
        }

        return $data;
    }

    







    // Ниже идут старые функции
    // которые использовались для тестового варианта
    // с использованием только laravel
    // без отдельного фронтенда

    // Показать меню добавления товара
    public function add()
    {
        return view('products.add');
    }

    // Добавление товара
    public function addProd(Request $request)
    {
        $formFields = $request->validate([
            'article' => 'required',
            'name' => 'required',
            'discription' => 'required',
            'category' => 'required',
            'price' => 'required'
        ]);

        if ($request->hasFile('logo'))
        {
            $formFields['path'] = $request->file('logo')->store('logos', 'public');
        }

        Products::create($formFields);

        return redirect('/')->with('message', 'Товар успешно добавлен!');
    }

    // Удаление товара 
    public function destroy(Request $request)
    {
        $deleteItem = $request->product;

        DB::table('products')->where('id', '=', $deleteItem)->delete();

        return redirect('/')->with('message', 'Товар успешно удален!');
    }

    // Меню редактирования категорий
    public function category(Products $products)
    {
        return view('products.category', [
            'product' => $products
        ]);
    }

    // Редактирование категорий
    public function change(Request $request, Products $products)
    {
        $formFields = $request->validate([
            'category' => 'required'
        ]);

        $products->update($formFields);

        return back()->with('message', 'Категории обновлены');
    }
}
