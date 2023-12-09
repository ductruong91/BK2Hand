<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-3">{{ __('Khám phá danh mục') }}</h1>
            <div class="bg-white overflow-hidden shadow-sm border border-[#BEB1B1] rounded-sm">
                <div class="pt-3 pb-2">
                    <div class="flex items-center justify-evenly">
                        @foreach($categories as $category)
                        <a class="cursor-pointer" href="{{ route('product.search', ['categoryId' => $category->category_id]) }}">
                            <div class="flex flex-col items-center">
                                <div class="w-[104px] h-[104px]">
                                    <img class="max-w-full min-h-full border border-[#D9C2C2] object-scale-down rounded-2xl" 
                                        src="/storage/xemay.PNG">
                                </div>
                                <span class="text-base mt-1">{{ $category->name }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <h1 class="text-2xl font-bold mb-3 mt-5">{{ __('Bài đăng mới') }}</h1>
            <div class="overflow-hidden grid grid-cols-5 gap-y-5 gap-x-8">
                @foreach($products as $product)
                <a class="border border-[#897272] bg-white block pt-4"
                    href="">
                    <div class="w-[174px] h-[156px] mx-auto mt-4">
                        <img class="max-w-full max-h-full mx-auto" src="https://i.pinimg.com/originals/29/80/96/2980962a6b06b61a1a3a21acb7dfb4f0.png"/>
                    </div>
                    <div class="flex flex-col ml-3 mb-1">
                        <span class="text-lg">{{ $product->name }}</span>
                        <span class="text-lg text-[#EC1B1B]">{{ number_format($product->price) }}đ</span>
                        <i class="fi fi-rs-clock-five flex items-center">
                            <span class="text-sm not-italic mx-2">{{ $product->created_at->diffForHumans() }}</span>
                        </i>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $products->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</x-app-layout>
