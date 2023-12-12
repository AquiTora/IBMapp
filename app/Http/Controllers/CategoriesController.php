<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Показать все категории
    public function index()
    {
        return view('categories.index', [
            'categories' => Categories::get()
        ]);
    }
}
