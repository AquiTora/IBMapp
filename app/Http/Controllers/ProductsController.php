<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'discription' => $data[2],
                'category' => $data[3],
                'price' => $data[4]
            ]);
        }

        return redirect('/')->with('success', 'CSV file imported successfully.');
    }
}
