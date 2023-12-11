<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    // Показывает форму для загрузки файла csv
    public function importForm()
    {
        return view('import');
    }

    // Загружает csv файл
    public function import(Request $request)
    {  
        $notInsert = [];
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        unset($fileContents[0]);

        foreach ($fileContents as $line)
        {
            $data = str_getcsv($line);

            $formFields = [
                'article' => $data[0],
                'name' => $data[1],
                'path' => $data[2],
                'discription' => $data[3],
                'category' => $data[4],
                'price' => $data[5]
            ];

            if (!(DB::table('products')->where('article', $data[0])->exists()))
            {
                Products::create($formFields);
            }
            else
            {
                array_push($notInsert, $formFields);
            }
        }

        return view('import', [
            'notInsert' => $notInsert
        ]);
    }
}
