<x-layout>
    @auth
    <div class='lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4'>
        @unless (count($orders) == 0)
            @foreach ($orders as $order)
                <div class='bg-gray-50 border border-gray-200 rounded p-6'>
                    <div class="flex">
                        <div>
                            <h3 class="text-2xl">
                                Имя заказчика: {{$order->name}}
                            </h3>
                            <div class="text-xl font-bold mb-4">
                                Телефон: {{$order->phone}}
                            </div>
                            <div class="text-xl font-bold mb-4">
                                Электронная почта: {{$order->email}}
                            </div>
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
        <a href="/">
            Вас здесь быть не должно
        </a>
    
    @endauth
</x-layout>