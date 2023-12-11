<x-layout>
    {{-- @auth --}}
    <form action="/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".csv">
        <button type="submit">Import CSV</button>
    </form>

    <div class='lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4'>
        @unless (count($notInserts) == 0)
            <h1>Уже есть в базе:</h1>
            @foreach ($notInserts as $notInsert)
                <div class='bg-gray-50 border border-gray-200 rounded p-6'>
                    <div class="flex">
                        <div>
                            <h3 class="text-2x1">
                                {{$notInsert['name']}}
                            </h3>
                            <div class="text-x1 font-bold mb-4">
                                Артикул: {{$notInsert['article']}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Все продукты загружены</p>
        @endunless
    </div>

    @else
        <a href="/">Страница для сотрудников</a>
    {{-- @endauth --}}
</x-layout>