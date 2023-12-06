<x-layout>
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Заявка на покупку {{$product->name}}
            </h2>
            <p class="mb-4">Заполните форму</p>
        </header>

        <form method="POST" action='/user/{{$product->id}}'>
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Ваше имя
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
                <label for="phone" class="inline-block text-lg mb-2">
                    Номер телефона
                </label>
                <input 
                    type="tel"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="phone"
                    value="{{old('phone')}}"
                />

                @error('phone')
                    <p>{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for='email' class="inline-block text-lg mb-2">
                    Электронная почта
                </label>
                <input 
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    value="{{old('email')}}"
                />

                @error('email')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-black text-white rounded py-2 px-4 hover:bg-black">
                    Создать заявку
                </button>

                <a href="/" class="text-black ml-4"> Назад </a>
            </div>

        </form>
    </div>
</x-layout>