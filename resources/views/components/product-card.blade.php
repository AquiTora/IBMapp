@props(['product'])

<div class='bg-gray-50 border border-gray-200 rounded p-6'>
    <div class="flex">
        <div>
            <h2>
                Название: {{$product->name}}
            </h2>
            <x-product-cat :categorysCsv="$product->category" />
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

            @auth
                <form method="POST" action="/{{$product->id}}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>
                </form>
                <div>
                    <a href='/category/{{$product->id}}/edit'>
                        Редактировать категории
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
