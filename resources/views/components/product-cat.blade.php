@props(['category'])

<a 
    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
    href='/?category={{$category}}'
>
    {{$category}}
</a>
