<x-layout>
    @auth
    <div class='lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4'>
        @unless (count($orders) == 0)
            @foreach ($orders as $order)
                <div class='bg-gray-50 border border-gray-200 rounded p-6'>
                    <div class="flex">
                        <div>
                            <h2>
                                Имя заказчика: {{$order->name}}
                            </h2>
                            <div>
                                Телефон: {{$order->phone}}
                            </div>
                            <p>
                                Электронная почта: {{$order->email}}
                            </p>
                            <p>
                                Имя товара: {{$order->product}}
                            </p>
                            <p>
                                Артикул: {{$order->article}}
                            </p>
                            <p>
                                Цена: {{$order->price}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endunless
    </div>
    
    @else
        <h1>
            Вас здесь быть не должно
        </h1>
    
    @endauth
</x-layout>