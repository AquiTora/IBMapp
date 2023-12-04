<x-layout>    
    <div class="p-10 max-w-lg mx-auto mt-24">
        <a href="/" class="inline-block text-black ml-4 mb-4">
            <i class="fa-solid fa-arrow-left"></i> Назад
        </a>
    
        <form method="POST" action="/category/{{$product->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Категории
                </label>
                <input 
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name='category'
                    value="{{$product->category}}"
                />
            </div>

            <div class="mb-6">
                <button class="bg-black text-white rounded py-2 px-4 hover:bg-black">
                    Обновить
                </button>
            </div>
        </form>
    </div>
</x-layout>