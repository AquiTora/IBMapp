<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    // Показать форму заявки
    public function create(Products $product)
    {
        return view('orders.order', [
            'product' => $product
        ]);
    }
    
    // Создать заявку
    public function store(Request $request, Products $product)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $formFields['product_id'] = $product->id;

        Orders::create($formFields);

        return redirect('/')->with('message', 'Заказ успешно создан!');
    }

    // Показывает список заявок
    public function showOrder()
    {
        $orders = DB::table('orders')
            ->join('products', 'product_id', '=', 'products.id')
            ->select('orders.*', 'products.name as product', 'products.article', 'products.price')
            ->get();
                
        return view('orders.showOrder', [
            'orders' => $orders
        ]);
    }
}
