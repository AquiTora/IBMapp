<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    // Показать форму заявки
    public function create(Products $product)
    {
        return view('products.order', [
            'product' => $product
        ]);
    }

    public function store(Request $request, Products $product)
    {
        // dd($product->id);
        // dd($request);
        $formFields = $request->validate([
            'name' => 'required',
            'phon' => 'required',   //Надо будет исправить
            'email' => 'required',
        ]);

        $formFields['product_id'] = $product->id;

        // dd($formFields);

        Orders::create($formFields);

        return redirect('/')->with('message', 'Заказ успешно создан!');
    }
}
