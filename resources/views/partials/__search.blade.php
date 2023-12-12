<form method="GET" action="/">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>
        <input 
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
            type="text" 
            name="search" 
            placeholder="Поиск товара по названию..."/>
        <div class="absolute top-2 right-2">
            <button class="h-10 w-20 text-white rounded-lg bg-black hover:bg-black" type="submit">
                Поиск
            </button>
        </div>
    </div>
</form>