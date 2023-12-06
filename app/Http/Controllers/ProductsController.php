<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
    // Показывает все продукты
    public function index()
    {
        return view('products.index', [
            'products' => Products::latest()
                ->filter(request(['category']))
                ->get()
        ]);
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

    public function change(Request $request, Products $products)
    {
        $formFields = $request->validate([
            'category' => 'required'
        ]);

        $products->update($formFields);

        return back()->with('message', 'Категории обновлены');
    }
    
    // Показывает форму для загрузки файла csv
    public function importForm()
    {
        return view('import');
    }

    // Загружает csv файл
    public function import(Request $request)
    {  
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        unset($fileContents[0]);

        foreach ($fileContents as $line)
        {
            $data = str_getcsv($line);

            Products::create([
                'article' => $data[0],
                'name' => $data[1],
                'path' => $data[2],
                'discription' => $data[3],
                'category' => $data[4],
                'price' => $data[5]
            ]);
        }

        return redirect('/')->with('success', 'CSV file imported successfully.');
    }

    // Показать форму для экспорта CSV
    public function exportForm()
    {
        return view('export');
    }

    // Экспорт CSV
    public function export()
    {
        $products = Products::all();
        $csvFileName = 'products.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['article', 'name', 'discription', 'categoty', 'price']);

        foreach ($products as $product)
        {
            fputcsv($handle, [$product->article, $product->name, $product->path, $product->discription, $product->category, $product->price]);
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
