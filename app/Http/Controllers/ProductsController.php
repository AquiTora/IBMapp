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
    // Отправляет все продукты
    public function index(): JsonResponse
    {
        $products = Products::all()->toArray();
        $data = [];
        
        foreach ($products as $product)
        {
            $product['category_name'] = DB::table('categories')
                ->where('id', '=', $product['category_id'])
                ->get('name')[0]
                ->name;

            array_push($data, $product);
        }

        return response()->json($data);
    }

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
