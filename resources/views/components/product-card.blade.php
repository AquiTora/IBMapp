@props(['product'])

<div class='bg-gray-50 border border-gray-200 rounded p-6'>
    <div class="flex">
        <div>
            <h2>
                Название: {{$product->name}}
            </h2>
            <x-product-cat :category="$product->category" />
            <div>
                Артикул: {{$product->article}}
            </div>
            <p>
                {{$product->discription}}
            </p>

            <p>
                Цена: {{$product->price}}
            </p>

            <div>
                <a href="/order/{{$product->id}}">
                    Оставить заявку на покупку
                </a>
            </div>
        </div>
    </div>
</div>
