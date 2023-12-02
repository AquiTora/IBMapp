<x-layout>
    <h1>Заявка на покупку {{$product->name}}, {{$product->id}}</h1>

    <form method="POST" action='/user/{{$product->id}}' enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">
                Ваше имя
            </label>
            <input 
                type="text"
                name="name"
                value="{{old('name')}}"
            />

            @error('name')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="phon">
                Номер телефона
            </label>
            <input 
                type="tel"
                name="phon"
            />

            @error('phon')
                <p>{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for='email'>
                Электронная почта
            </label>
            <input 
                type="text"
                name="email"
                value="{{old('email')}}"
            />

            @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div>
            <button>
                Создать заявку
            </button>
        </div>

    </form>
</x-layout>