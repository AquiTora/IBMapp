<x-layout>
    @auth
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Добавить товар
            </h2>
            <p class="mb-4">Напишите какой товар нужно добавить</p>
        </header>

        <form method="POST" action="/addProd" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Название товара
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{old('name')}}"
                />

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="article" class="inline-block text-lg mb-2">
                    Артикул
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="article"
                    value="{{old('article')}}"
                />

                @error('article')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="discription" class="inline-block text-lg mb-2">
                    Описание
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="discription"
                    value="{{old('discription')}}"
                />

                @error('discription')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price" class="inline-block text-lg mb-2">
                    Цена
                </label>
                <input 
                    type="number"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="price"
                    value="{{old('price')}}"
                />

                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category" class="inline-block text-lg mb-2">
                    Категория
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="category"
                    value="{{old('category')}}"
                />

                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{-- <div class="mb-6">
                <label for="photo" class="inline-block text-lg mb-2">
                    Фото товара
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="photo"
                />

                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div> --}}

            <div class="mb-6">
                <button class="bg-black text-white rounded py-2 px-4 hover:bg-black">
                    Добавить товар
                </button>

                <a href="/" class="text-black ml-4"> Вернуться </a>
            </div>
        </form>
    </div>
    @else
        <a href="/">Вас здесь быть не должно</a>

    @endauth
</x-layout>