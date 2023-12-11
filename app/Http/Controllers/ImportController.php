<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    // Показывает форму для загрузки файла csv
    public function importForm(array $notInserts = [])
    {
        return view('import', [
            'notInserts' => $notInserts
        ]);
    }

    // Загружает csv файл
    public function import(Request $request)
    {  
        $notInserts = [];
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
                'price' => $data[5]
            ];

            $categoryFields = [
                'name' => $data[4]
            ];

            if (!(DB::table('products')->where('article', $data[0])->exists()))
            {
                $lastId = Categories::create($categoryFields);

                $formFields['category_id'] = $lastId->id;

                Products::create($formFields);
            }
            else
            {
                array_push($notInserts, $formFields);
            }
        }

        return ImportController::importForm($notInserts);
    }
}
