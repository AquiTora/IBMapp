@props(['product'])

<div class='bg-gray-50 border border-gray-200 rounded p-6'>
    <div class="flex">
        <img 
            class="hidden w-48 mr-6 md:block"
            src="{{$product->path ? asset('storage/' . $product->path) : asset('/images/no-image.jpg')}}"
            alt=""
        />
        <div>
            <h3 class="text-2x1">
                <a href="/order/{{$product->id}}">{{$product->name}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">
                Артикул: {{$product->article}}
            </div>

            <x-product-cat :categorysCsv="$product->category" />
            
            <div class="text-lg mt-4">
                <p class="bold">
                    {{$product->discription}}
                </p>

                <p>
                    Цена: {{$product->price}}
                </p>
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
