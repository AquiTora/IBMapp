@props(['categorysCsv'])

@php
    $categorys = explode(',', $categorysCsv);
@endphp

<ul class="flex">
    @unless (count($categorys) == 0)
        @foreach ($categorys as $category)
            <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                <a href='/?category={{$category}}'>
                    {{$category}}
                </a>
            </li>
        @endforeach

        @else
            <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                Нет категорий
            </li>
    @endunless
</ul>
