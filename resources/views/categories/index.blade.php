<x-layout>
    <div>
        @unless (count($categories) == 0)
            @foreach ($categories as $category)
                <div>
                    <h1>{{$category->name}}</h1>
                </div>                
            @endforeach

            @else
                <h1>Нет категорий</h1>
        @endunless
    </div>
</x-layout>