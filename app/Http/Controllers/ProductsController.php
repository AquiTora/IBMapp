<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

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

    // Показать форму заявки 
    public function order(Products $product)
    {
        return view('products.order', [
            'product' => $product
        ]);
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
