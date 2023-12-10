<div class="relative" x-data="{ open: false }" @mouseover.away="open = false" @close.stop="open = false">
    <div @mouseover="open = true">
        <button class="h-[55px] shrink-0 self-center ml-10 text-lg w-[122px] flex justify-center bg-white py-3 px-4 rounded-lg">
            <span class="block">{{ __('Danh mục') }}</span>
        </button>
    </div>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 rounded-md shadow-lg ltr:origin-top-left rtl:origin-top-right start-0 flex bg-white items-start justify-start"
        style="display: none;">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white py-1 dark:bg-gray-700 w-48">
            @foreach($categories as $key => $category)
            <a class="w-full px-4 py-2 text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out flex items-center justify-between"
                href="{{ route('product.search', ['cid' => $category->category_id]) }}"
                wire:mouseenter="update({{ $key }})"
            >
                <div class="text-start text-base leading-5">{{ $category->name }}</div>
                @if (count($category->subCategories)) <span><i class="fi fi-bs-angle-right"></i></span> @endif
            </a>
            @endforeach
        </div>
        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white py-1 dark:bg-gray-700 w-48">
            @foreach($subCategories as $subCategory)
            <a class="w-full px-4 py-2 text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out flex items-center justify-between"
                href="{{ route('product.search', ['cid' => $subCategory->category_id]) }}"
            >
                <div class="text-start text-base leading-5">{{ $subCategory->name }}</div>
                @if (count($subCategory->subCategories)) <span><i class="fi fi-bs-angle-right"></i></span> @endif
            </a>
            @endforeach
        </div>
    </div>
</div>
