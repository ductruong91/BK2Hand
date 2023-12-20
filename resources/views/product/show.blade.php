<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-start justify-start">
                <div class="w-[60%] my-3">
                    <div id="main-image-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#main-image-carousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                            @for ($i = 1; $i < count($product->images) + count($product->videos); $i++)
                                <button type="button" data-bs-target="#main-image-carousel" data-bs-slide-to="{{ $i }}"></button>
                            @endfor
                        </div>
                        <div class="carousel-inner bg-white h-[550px]">
                            <div class="carousel-item active">
                                <img src="{{ $product->images->first()->image_url }}" class="d-block max-h-[550px] w-full object-contain mx-auto">
                            </div>
                            @foreach($product->images->slice(1) as $image)
                            <div class="carousel-item">
                                <img src="{{ $image->image_url }}" class="d-block max-h-[550px] w-full object-contain mx-auto">
                            </div>
                            @endforeach
                            @foreach($product->videos as $video)
                            <div class="carousel-item">
                                <video autoplay loop controls name="media" class="d-block max-h-[550px] w-full object-contain mx-auto">
                                    <source src="{{ $video->video_url }}">
                                </video>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#main-image-carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true"></span>
                            <span class="hidden">{{ __('Previous') }}</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#main-image-carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true"></span>
                            <span class="hidden">__{{ __('Next') }}</span>
                        </button>
                    </div>
                    <div id="bottom-btn" class="flex items-center space-x-4 mt-3.5">
                        <button type="button" data-bs-target="#main-image-carousel" data-bs-slide-to="0" class="bg-white">
                            <img src="{{ $product->images->first()->image_url }}" class="max-h-[120px] w-full object-contain"/>
                        </button>
                        @foreach($product->images->slice(1) as $key => $image)
                        <button type="button" data-bs-target="#main-image-carousel" data-bs-slide-to="{{ $key }}" class="bg-white">
                            <img src="{{ $image->image_url }}" class="max-h-[120px] w-full object-contain"/>
                        </button>
                        @endforeach
                        @foreach($product->videos as $key => $video)
                        <button type="button" data-bs-target="#main-image-carousel" data-bs-slide-to="{{ count($product->images) + $key }}" class="bg-white">
                            <video muted class="max-h-[120px] w-full object-contain" src="{{ $video->video_url }}">
                            </video>
                        </button>
                        @endforeach
                    </div>
                    <div class="mt-3.5 py-8 px-5 bg-white">
                        <span class="block text-3xl font-bold">
                            {{ $product->name }}
                        </span>
                        <span class="block text-[#EC1B1B] font-bold text-3xl">
                            {{ number_format($product->price, 0, ',', '.') }} đ
                        </span>
                        <div class="ml-3 py-3">
                            <span class="block text-lg py-1">
                                {{ __('Danh mục: :category_name', ['category_name' => $product->category_by_word]) }}
                            </span>
                            <span class="block text-lg py-1">
                                {{ __('Thời gian sử dụng: :time_used', ['time_used' => $product->time_used_by_word]) }}
                            </span>
                        </div>
                        <div class="">
                            <span class="block text-2xl font-bold">
                                {{ __('Mô tả chi tiết') }}
                            </span>
                            <ul class="list-disc ml-5 text-xl">
                                <li>{{ $product->description }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-[35%] my-3 mx-4 bg-white px-3.5 pt-5 pb-4 border-[#AF9A9A] border flex">
                    <div class="w-[90px] h-[90px]">
                        <img src="{{ $product->user->avatar }}" class="object-cover max-w-full max-h-full"/>
                    </div>
                    <div class="flex items-start flex-col ml-4">
                        <div class="rounded-2xl flex items-center justify-center px-6 py-1 border-2 border-[#746767]">
                            <span class="text-2xl font-bold leading-7">{{ $product->user->name }}</span>
                        </div>
                        <div class="mt-2">
                            <span class="text-xl font-normal">{{ __('Số điện thoại :') }}</span>
                            <span class="text-xl font-bold">{{ $product->user->phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bài đăng tương tự -->
            <div class="bg-white mt-3 p-3">
                <h1 class="text-2xl font-bold leading-7">{{ __('Bài đăng tương tự') }}</h1>
                <div class="flex items-center justify-evenly mt-4">
                    @foreach($similarProducts as $product)
                        <a class="border border-[#897272] rounded-2xl bg-white block pt-4 hover:shadow-lg"
                            href="{{ route('product.show', ['id' => $product->product_id]) }}">
                            <div class="w-[174px] h-[156px] mx-5 mt-4 rounded-2xl">
                                <img class="mx-auto max-h-full max-w-full object-contain" src="{{ $product->thumbnail_image->image_url }}" />
                            </div>
                            <div class="flex flex-col ml-3 mb-1">
                                <span class="text-lg">
                                    {{ $product->name }}
                                </span>
                                <span class="text-lg text-[#EC1B1B]">
                                    {{ number_format($product->price , 0, ',', '.') }}đ
                                </span>
                                <i class="fi fi-rs-clock-five flex items-center">
                                    <span class="text-sm not-italic mx-2">
                                        {{ $product->created_at->diffForHumans() }}
                                    </span>
                                </i>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        const carousel = document.getElementById('main-image-carousel')
        const bottomBtn = document.getElementById('bottom-btn')
        const activeBtn = carousel.querySelector('div.carousel-indicators').querySelector('button.active').getAttribute('data-bs-slide-to')
        const buttons = bottomBtn.querySelectorAll('button')
        for (const btn of buttons) {
            if (btn.getAttribute('data-bs-slide-to') == activeBtn) {
                btn.classList.add('border', 'border-[#EC1B1B]')
            }
        }
        carousel.addEventListener('slide.bs.carousel', event => {
            for (const btn of buttons) {
                if(btn.getAttribute('data-bs-slide-to') == event.from) {
                    btn.classList.remove('border','border-[#EC1B1B]')
                }
                if(btn.getAttribute('data-bs-slide-to') == event.to) {
                    btn.classList.add('border', 'border-[#EC1B1B]')
                }
            }
        })
    </script>
</x-app-layout>