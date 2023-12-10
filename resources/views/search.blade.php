<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center space-x-6">

            <!-- Price range -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-lg leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ __('Giá') }}</div>

                        <div class="ms-1">
                            <i class= "fi fi-rr-caret-down" ></i>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <button class="w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        {{ ('Khoang gia') }}
                    </button>
                </x-slot>
            </x-dropdown>

            <!-- Sort by price -->
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-lg leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Xếp theo giá') }}</div>

                <div class="ms-1">
                    <i class= "fi fi-ss-arrow-small-down" ></i>
                </div>
            </button>

            <!-- Used time -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-lg leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ __('Thời gian') }}</div>

                        <div class="ms-1">
                            <i class= "fi fi-rr-caret-down" ></i>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <a>Khoang gia</a>
                </x-slot>
            </x-dropdown>

            <!-- Sort by creation time -->
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-lg leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Xếp theo ngày đăng') }}</div>

                <div class="ms-1">
                    <i class= "fi fi-ss-arrow-small-down" ></i>
                </div>
            </button>

            <!-- Filter -->
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-lg leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div class="mr-1 text-base">
                    <i class= "fi fi-rs-filter" ></i>
                </div>
            
                <div>{{ __('Lọc') }}</div>
            </button>

            <!-- Reset Filter -->
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-lg leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Khôi phục lọc') }}</div>
            </button>

        </div>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 justify-items-center gap-y-4">
                @foreach($products as $product)
                <a class="cursor-pointer w-full flex justify-center" href="{{ route('product.show', ['id' => $product->product_id]) }}">
                    <div class="flex items-start py-5 px-5 bg-white rounded-2xl border border-[#897272] max-w-[507px] hover:scale-105 w-full">
                        <div class="w-[174px] h-[156px] flex items-center">
                            <img class="max-w-full max-h-full mx-auto my-auto" src="https://www.infobike.hu/media/pictures/1274046656honda_anf125_2004_7.jpg"/>
                        </div>
                        <div class="flex ml-5 flex-col">
                            <span class="text-2xl block">{{ $product->name }}</span>
                            <span class="text-lg text-[#EC1B1B]">{{ number_format($product->price , 0, ',', '.') }}đ</span>
                            <span class="text-lg text-black">{{ __('Danh mục: :category', ['category' => $product->name]) }}</span>
                            <span class="text-lg text-black">{{ __('Thời gian sử dụng: :time', ['time' => '3 năm']) }}</span>
                        </div>
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
