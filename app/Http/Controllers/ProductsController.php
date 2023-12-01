<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // Show all products
    public function index()
    {
        return view('products.index');
    }
}
