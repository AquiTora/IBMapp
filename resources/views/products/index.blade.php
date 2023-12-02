<x-layout>
    <div class='lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4'>
        @unless (count($products) == 0)
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach

            @else
                <p>Нет товаров</p>
        @endunless
    </div>
</x-layout>