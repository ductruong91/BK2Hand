<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center space-x-5">

            <div class="relative" onclick="toggleDropdown()">
                <div class="py-2 px-7 bg-white text-base border border-[rgba(0,0,0,0.5)] rounded-md inline-flex items-center">
                    <span id="priceRangeTitle" class="block leading-4 font-medium text-base px-2">{{ __('Giá')}}</span><i class= "fi fi-rr-caret-down px-2" ></i>
                </div>
                <div class="absolute z-50 mt-2 w-32 rounded-sm shadow-lg">
                    <div class="ring-1 ring-black ring-opacity-5 bg-white" id="priceRangeSelector" style="display:none;">
                        <div class="text-sm py-1 px-2" data-price-range="0">{{ __('Không')}}</div>
                        <div class="text-sm py-1 px-2" data-price-range="1">{{ __('Dưới 100.000')}}</div>
                        <div class="text-sm py-1 px-2" data-price-range="2">{{ __('Dưới 500.000')}}</div>
                        <div class="text-sm py-1 px-2" data-price-range="3">{{ __('Dưới 1000.000')}}</div>
                        <div class="text-sm py-1 px-2" data-price-range="4">{{ __('Trên 1000.000')}}</div>
                    </div>
                </div>
            </div>

            <!-- Sort by price -->
            <!-- <div id="sortByPrice" class="inline-flex items-center px-7 py-3 border border-[rgba(0,0,0,0.5)] text-base leading-4 font-medium rounded-md text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Xếp theo giá') }}</div>
                <div class="ms-1 up" style="display: none;">
                    <i class= "fi fi-ss-arrow-small-up"></i>
                </div>
                <div class="ms-1 down" style="display: none;">
                    <i class= "fi fi-ss-arrow-small-down"></i>
                </div>
            </div> -->
            <div class="relative" onclick="togglePrice()">
                <div class="py-2 px-7 bg-white text-base border border-[rgba(0,0,0,0.5)] rounded-md inline-flex items-center">
                    <span id="sortPriceTitle" class="block leading-4 font-medium text-base px-2">{{ __('Thứ tự sắp xếp') }}</span><i class= "fi fi-rr-caret-down px-2" ></i>
                </div>
                <div class="absolute z-50 mt-2 w-52 rounded-sm shadow-lg">
                    <div class="ring-1 ring-black ring-opacity-5 bg-white" id="sortPriceSelector" style="display:none;">
                        <div class="text-sm py-1 px-2" data-sort-price="0">{{ __('Không')}}</div>
                        <div class="text-sm py-1 px-2" data-sort-price="1">{{ __('Tăng dần')}}<i class= "fi fi-ss-arrow-small-up"></i></div>
                        <div class="text-sm py-1 px-2" data-sort-price="2">{{ __('Giảm dần')}}<i class= "fi fi-ss-arrow-small-down"></i></div>
                    </div>
                </div>
            </div>

            <!-- Time used -->
            <div class="relative" onclick="toggleTimeUsed()">
                <div class="py-2 px-7 bg-white text-base border border-[rgba(0,0,0,0.5)] rounded-md inline-flex items-center">
                    <span id="timeUsedTitle" class="block leading-4 font-medium text-base px-2">{{ __('Thời gian') }}</span><i class= "fi fi-rr-caret-down px-2" ></i>
                </div>
                <div class="absolute z-50 mt-2 w-44 rounded-sm shadow-lg">
                    <div class="ring-1 ring-black ring-opacity-5 bg-white" id="timeUsedSelector" style="display:none;">
                        <div class="text-sm py-1 px-2" data-time-used="0">{{ __('Không')}}</div>
                        <div class="text-sm py-1 px-2" data-time-used="1">{{ __('Dưới 1 tháng')}}</div>
                        <div class="text-sm py-1 px-2" data-time-used="2">{{ __('Nhiều hơn 1 tháng')}}</div>
                        <div class="text-sm py-1 px-2" data-time-used="3">{{ __('Dưới 6 tháng')}}</div>
                        <div class="text-sm py-1 px-2" data-time-used="4">{{ __('6 tháng - 12 tháng')}}</div>
                        <div class="text-sm py-1 px-2" data-time-used="5">{{ __('1 năm - 1.5 năm')}}</div>
                        <div class="text-sm py-1 px-2" data-time-used="6">{{ __('1.5 năm - 2 năm')}}</div>
                    </div>
                </div>
            </div>

            <!-- Sort by creation date -->
            <!-- <div id="sortByCreatedAt" class="inline-flex items-center px-7 py-3 border border-[rgba(0,0,0,0.5)] text-base leading-4 font-medium rounded-md text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Xếp theo ngày đăng') }}</div>
                <div class="ms-1 down" style="display: none;">
                    <i class= "fi fi-ss-arrow-small-down"></i>
                </div>
                <div class="ms-1 up" style="display: none;">
                    <i class= "fi fi-ss-arrow-small-up"></i>
                </div>
            </div> -->

            <!-- Filter -->
            <button id="submitBtn" class="inline-flex items-center py-2 px-7 border border-[rgba(0,0,0,0.5)] text-base leading-4 font-medium rounded-md text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div class="mr-1 text-base px-2">
                    <i class= "fi fi-rs-filter" ></i>
                </div>
            
                <div class="text-base">{{ __('Lọc') }}</div>
            </button>

            <!-- Reset Filter -->
            <button id="resetBtn" class="inline-flex items-center py-3 px-7 border border-[rgba(0,0,0,0.5)] text-base leading-4 font-medium rounded-md text-black dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ __('Khôi phục lọc') }}</div>
            </button>

            <script>
                const url = new URL(window.location.href);
                const priceRangeStartTitle = "Giá";
                const timeUsedTitle = "Thời gian";
                const sortPriceTitle = "Thứ tự sắp xếp";
                const priceRangeTitleElement = document.getElementById('priceRangeTitle')
                const priceRangeSelector = document.getElementById('priceRangeSelector')
                function toggleDropdown() {
                    const element = document.getElementById('priceRangeSelector')
                    element.style.display = element.style.display == 'none' ? 'block' : 'none'; 
                }
                function togglePrice() {
                    const element = document.getElementById('sortPriceSelector')
                    element.style.display = element.style.display == 'none' ? 'block' : 'none'; 
                }
                function toggleTimeUsed() {
                    const element = document.getElementById('timeUsedSelector')
                    element.style.display = element.style.display == 'none' ? 'block' : 'none'; 
                }
                const priceRangeOptions = priceRangeSelector.querySelectorAll('div')

                for (const option of priceRangeOptions)
                {
                    if (option.getAttribute('data-price-range') == url.searchParams.get('priceRange')) {
                        priceRangeTitleElement.innerHTML = `${priceRangeStartTitle}: ${option.innerHTML}`;
                    }
                }

                priceRangeOptions.forEach((element) => element.addEventListener('click', () => {
                    priceRangeTitleElement.innerHTML = `${priceRangeStartTitle}: ${element.innerHTML}`;
                    url.searchParams.set('priceRange', element.getAttribute('data-price-range'))
                    window.history.pushState({}, "", url)
                }))
                document.getElementById('sortPriceSelector').querySelectorAll('div').forEach((element) => element.addEventListener('click', () => {
                    document.getElementById('sortPriceTitle').innerHTML = `${sortPriceTitle}: ${element.innerHTML}`
                    url.searchParams.set('sortByPrice', element.getAttribute('data-sort-price'))
                    window.history.pushState({}, "", url)
                }))
                document.getElementById('timeUsedSelector').querySelectorAll('div').forEach((element) => element.addEventListener('click', () => {
                    document.getElementById('timeUsedTitle').innerHTML = `${timeUsedTitle}: ${element.innerHTML}`
                    url.searchParams.set('timeUsed', element.getAttribute('data-time-used'))
                    window.history.pushState({}, "", url)
                }))

                document.getElementById('submitBtn').addEventListener('click', () => {
                    window.location.href = window.location.href
                })

                document.getElementById('resetBtn').addEventListener('click', () => {
                    url.searchParams.delete('page')
                    url.searchParams.delete('priceRange')
                    url.searchParams.delete('sortByPrice')
                    url.searchParams.delete('timeUsed')
                    url.searchParams.delete('sortByCreatedAt')
                    window.location.href = url
                })

                const sortByPrice = document.getElementById('sortByPrice');
                switch (url.searchParams.get('sortByPrice')) {
                    case '0':
                        sortByPrice.querySelector('div.down').style.display = 'none';
                        sortByPrice.querySelector('div.up').style.display = 'none';
                        break;
                    case '1':
                        sortByPrice.querySelector('div.down').style.display = 'none';
                        sortByPrice.querySelector('div.up').style.display = 'block';
                        break;
                    case '2':
                        sortByPrice.querySelector('div.down').style.display = 'block';
                        sortByPrice.querySelector('div.up').style.display = 'none';
                        break;
                    default:
                        sortByPrice.querySelector('div.down').style.display = 'none';
                        sortByPrice.querySelector('div.up').style.display = 'none';
                        break;
                }
                sortByPrice.addEventListener('click', () => {
                    switch (url.searchParams.get('sortByPrice'))
                    {
                        case '0':
                            url.searchParams.set('sortByPrice', '1');
                            window.history.pushState({}, "", url)
                            sortByPrice.querySelector('div.down').style.display = 'none';
                            sortByPrice.querySelector('div.up').style.display = 'block';
                            break;
                        case '1':
                            url.searchParams.set('sortByPrice', '2');
                            window.history.pushState({}, "", url)
                            sortByPrice.querySelector('div.down').style.display = 'block';
                            sortByPrice.querySelector('div.up').style.display = 'none';
                            break;
                        case '2':
                            url.searchParams.set('sortByPrice', '0');
                            window.history.pushState({}, "", url)
                            sortByPrice.querySelector('div.down').style.display = 'none';
                            sortByPrice.querySelector('div.up').style.display = 'none';
                            break;
                        default:
                            url.searchParams.set('sortByPrice', '1');
                            window.history.pushState({}, "", url)
                            sortByPrice.querySelector('div.down').style.display = 'none';
                            sortByPrice.querySelector('div.up').style.display = 'block';
                    }
                })
                const sortByCreatedAt = document.getElementById("sortByCreatedAt")
                switch (url.searchParams.get('sortByCreatedAt')) {
                    case '0':
                        sortByCreatedAt.querySelector('div.down').style.display = 'none';
                        sortByCreatedAt.querySelector('div.up').style.display = 'none';
                        break;
                    case '1':
                        sortByCreatedAt.querySelector('div.down').style.display = 'none';
                        sortByCreatedAt.querySelector('div.up').style.display = 'block';
                        break;
                    case '2':
                        sortByCreatedAt.querySelector('div.down').style.display = 'block';
                        sortByCreatedAt.querySelector('div.up').style.display = 'none';
                        break;
                    default:
                        sortByCreatedAt.querySelector('div.down').style.display = 'none';
                        sortByCreatedAt.querySelector('div.up').style.display = 'none';
                        break;
                }
                sortByCreatedAt.addEventListener('click', () => {
                    switch (url.searchParams.get('sortByCreatedAt'))
                    {
                        case '0':
                            url.searchParams.set('sortByCreatedAt', '1');
                            window.history.pushState({}, "", url)
                            sortByCreatedAt.querySelector('div.down').style.display = 'none';
                            sortByCreatedAt.querySelector('div.up').style.display = 'block';
                            break;
                        case '1':
                            url.searchParams.set('sortByCreatedAt', '2');
                            window.history.pushState({}, "", url)
                            sortByCreatedAt.querySelector('div.down').style.display = 'block';
                            sortByCreatedAt.querySelector('div.up').style.display = 'none';
                            break;
                        case '2':
                            url.searchParams.set('sortByCreatedAt', '0');
                            window.history.pushState({}, "", url)
                            sortByCreatedAt.querySelector('div.down').style.display = 'none';
                            sortByCreatedAt.querySelector('div.up').style.display = 'none';
                            break;
                        default:
                            url.searchParams.set('sortByCreatedAt', '1');
                            window.history.pushState({}, "", url)
                            sortByCreatedAt.querySelector('div.down').style.display = 'none';
                            sortByCreatedAt.querySelector('div.up').style.display = 'block';
                    }
                })
            </script>
        </div>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 justify-items-center gap-x-8 gap-y-4">
                @foreach($products as $product)
                <a class="cursor-pointer max-w-[507px] w-full flex justify-center" href="{{ route('product.show', ['id' => $product->product_id]) }}">
                    <div class="flex items-start py-5 px-5 bg-white rounded-2xl border border-[#897272] max-w-[507px] hover:scale-105 w-full">
                        <div class="w-[174px] h-[156px] flex items-center">
                            <img class="max-w-full max-h-full mx-auto my-auto" src="{{$product->images->first()->image_url}}"/>
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
