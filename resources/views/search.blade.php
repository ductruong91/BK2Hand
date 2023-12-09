<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-left items-center space-x-6">

            <!-- Price range -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-2xl leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ __('Giá') }}</div>

                        <div class="ms-1">
                            <i class= "fi fi-rr-caret-down" ></i>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <a>Khoang gia</a>
                </x-slot>
            </x-dropdown>

            <!-- Sort by price -->
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-2xl leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Xếp theo giá') }}</div>

                <div class="ms-1">
                    <i class= "fi fi-ss-arrow-small-down" ></i>
                </div>
            </button>

            <!-- Used time -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-2xl leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-2xl leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Xếp theo ngày đăng') }}</div>

                <div class="ms-1">
                    <i class= "fi fi-ss-arrow-small-down" ></i>
                </div>
            </button>

            <!-- Filter -->
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-2xl leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div class="mr-1 text-base">
                    <i class= "fi fi-rs-filter" ></i>
                </div>
            
                <div>{{ __('Lọc') }}</div>
            </button>

            <!-- Reset Filter -->
            <button class="inline-flex items-center py-3 px-2 border border-[rgba(0,0,0,0.5)] text-2xl leading-4 font-medium rounded-lg text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Khôi phục lọc') }}</div>
            </button>

        </div>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2">

        </div>
    </div>
</x-app-layout>
