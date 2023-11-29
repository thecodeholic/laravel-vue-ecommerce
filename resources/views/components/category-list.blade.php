@props(['categoryList'])

<div {{ $attributes->merge(['class' => 'category-list flex text-white bg-slate-700']) }}>
    @if (!empty($categoryList))
        @foreach($categoryList as $category)
            <div class="category-item relative">
                <a href="{{ route('byCategory', $category) }}" class="cursor-pointer block py-3 px-6 hover:bg-black/10">
                    {{$category->name}}
                </a>
                <x-category-list class="absolute left-0 top-[100%] z-50 hidden flex-col" :category-list="$category->children"/>
            </div>
        @endforeach
    @endif
</div>
