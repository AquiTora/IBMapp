<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    // Показать форму для экспорта
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
