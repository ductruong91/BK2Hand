<x-app-layout>
    <div class="py-10 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach($categories as $key => $category)
            @if (count($category->subCategories)) 
                <!-- SubCategories Modal -->
                <div class="modal" id="{{ 'category' . $key . 'Modal' }}" tabindex="-1" aria-labelledby="{{ 'category' . $key . 'ModalTitle' }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="px-3 py-1 hover:text-gray-600 cursor-pointer" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                    <i class= "fi fi-bs-angle-left" ></i>
                                </div>
                                <h5 class="modal-title text-xl font-bold" id="{{ 'category' . $key . 'ModalTitle' }}">
                                    {{ $category->name }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class= "fi fi-br-cross" ></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <h1 class="text-xl font-bold">{{ __('Chọn danh mục') }}</h1>
                                <div class="flex flex-col items-center mt-5">
                                    @foreach($category->subCategories as $subCategory)
                                        <button class="flex items-center justify-between w-full h-12 border border-black px-3 hover:bg-gray-200 subcategory"
                                        data-name="{{ $subCategory->name }}" data-id="{{ $subCategory->category_id }}"
                                        data-bs-dismiss="modal" aria-label="Close">
                                            <span class="text-base font-normal block ml-3">{{ $subCategory->name }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach

            <!-- Modal -->
            <div class="modal fade" id="categoryModal" role="dialog" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Header -->
                        <div class="modal-header">
                            <h5 class="modal-title text-xl font-bold" id="categoryModalLabel">Đăng tin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class= "fi fi-br-cross" ></i>
                            </button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">
                            <h1 class="text-xl font-bold">{{ __('Chọn danh mục') }}</h1>
                            <div class="flex flex-col items-center mt-5">
                                @foreach($categories as $key => $category)
                                    <button class="flex items-center justify-between w-full h-12 border border-black px-3 hover:bg-gray-200 @if(!count($category->subCategories)) subcategory @endif"
                                        {!! count($category->subCategories) ? "data-bs-toggle='modal' data-bs-target='" . "#category" . $key . "Modal'" : "data-bs-dismiss='modal' aria-label='Close'" !!}
                                        data-name="{{ $category->name }}" data-id="{{ $category->category_id }}">
                                        <span class="text-base font-normal block ml-3">{{ $category->name }}</span>
                                        @if (count($category->subCategories))
                                        <span class="block">
                                            <i class="fi fi-bs-angle-right"></i>
                                        </span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="flex">
                @csrf
                <!-- Images and Videos -->
                <div class="w-[45%] my-3">
                    <div class="flex flex-col items-center justify-evenly h-full">
                        <div>
                            <span class="text-2xl font-normal">{{ __('Hình ảnh và Video sản phẩm') }}</span>
                        </div>
                        @error('images')
                        <span class="block text-base text-red-600">{{ $message }}</span>
                        @enderror
                        <div class="border border-[#FFB906] w-[200px] h-[170px] flex items-center justify-center cursor-pointer"
                            onclick="document.getElementById('images-input').click()">
                            <input id="images-input" name="images[]" type="file" accept=".jpg,.jpeg,.png" multiple class="hidden"
                            onchange="previewFile(event)"/>
                            <img id="image-icon" src="/storage/image.svg" class="object-contain w-[53px] h-[39px]"/>
                            <img id="image-preview" style="display:none;" class="max-w-full max-h-full w-full object-contain"/>
                        </div>
                        <div class="border border-[#FFB906] w-[200px] h-[170px] flex items-center justify-center cursor-pointer"
                            onclick="document.getElementById('video-input').click()">
                            <input id="video-input" name="video" type="file" accept=".mp4,.wmv,.webm,.avi,.mpeg" class="hidden"
                            onchange="previewFile(event)"/>
                            <img id="video-icon" src="/storage/video.svg" class="object-contain w-[53px] h-[39px]"/>
                            <video id="video-preview" muted loop style="display:none;"></video>
                        </div>
                    </div>
                </div>
                <div class="w-[55%] my-3 mx-4">
                    <div class="flex flex-col items-start w-[532px]">
                        <div data-bs-toggle="modal" data-bs-target="#categoryModal"
                            class="w-full h-[69px] border border-black rounded-xl flex items-center cursor-pointer">
                            <input id="category" type="hidden" value="{{ old('category_id') }}" name="category_id"/>
                            <div class="flex items-center justify-between px-4 w-full">
                                <span id="category_name" class="text-2xl pl-5">{{ __('Danh mục sản phẩm') }}</span>
                                <span class="text-4xl block"><i class= "fi fi-sr-caret-down" ></i></span>
                            </div>
                        </div>

                        @error('category_id')
                        <span class="block text-base text-red-600">{{ $message }}</span>
                        @enderror

                        <div class="mt-5 mb-3">
                            <h1 class="text-[22px] font-bold">
                                {{ __('Thông tin bài đăng') }}
                            </h1>
                        </div>
                        <div class="w-full h-[69px] border border-[rgba(0,0,0,0.32)] rounded-xl px-2 py-1 flex items-center">
                            <input name="title" type="text" value="{{ old('title') }}" autofocus
                                class="border-none focus:ring-0 focus:ring-offset-0 w-full placeholder:text-lg placeholder:text-[rgba(0,0,0,0.52)] text-lg" 
                                placeholder="Tiêu đề đăng tin (<30 ký tự)"/>
                        </div>
                        @error('title')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                        <div class="mt-8 flex items-center justify-between w-full">
                            <div class="w-[340px] h-[69px] border border-[rgba(0,0,0,0.32)] rounded-xl px-2 py-1 flex items-center">
                                <input name="time_used" type="number" value="{{ old('time_used') }}" autofocus
                                    class="border-none focus:ring-0 focus:ring-offset-0 w-full placeholder:text-lg placeholder:text-[rgba(0,0,0,0.52)] text-lg" 
                                    placeholder="Thời gian đã sử dụng"/>
                                <select name="unit" required>
                                    <option value="0">Tháng</option>
                                    <option value="1">Năm</option>
                                </select>
                            </div>
                            <div class="w-[168px] h-[69px] border border-[rgba(0,0,0,0.32)] rounded-xl px-2 py-1 flex items-center">
                                <input name="price" type="text" value="{{ old('price') }}" autofocus
                                        class="border-none focus:ring-0 focus:ring-offset-0 w-full placeholder:text-lg placeholder:text-[rgba(0,0,0,0.52)] text-lg" 
                                        placeholder="Giá"/>
                                <span class="text-gray-400">VND</span>
                            </div>
                        </div>
                        @error('time_used')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                        @error('price')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                        <div class="mt-8 w-[535px] h-[203px] border border-[rgba(0,0,0,0.32)] rounded-xl px-2 py-1 flex items-center">
                            <textarea name="description" cols="50" rows="6" placeholder="Mô tả chi tiết" value="{{ old('description') }}"
                                class="border-none focus:ring-0 focus:ring-offset-0 placeholder:text-lg">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="mt-8 py-4 px-12 rounded-[20px] bg-[#F40D0D] hover:bg-red-400 self-center">
                            <span class="text-2xl font-bold text-white">
                                {{ __('Đăng bài ') }}
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="module">
        const categoryName = document.getElementById('category_name')
        const categoryInput = document.getElementById('category')
        $(document).ready(function() {
            $('button.subcategory').click(function () {
                var newCategoryName = $(this).data('name')
                var newCategoryId = $(this).data('id')
                categoryName.innerHTML = 'Danh mục sản phẩm: ' + newCategoryName
                categoryInput.value = newCategoryId;
            })
        })
        if (categoryInput.value) {
            axios.get('/api/categories/' + categoryInput.value)
                .then(res => categoryName.innerHTML = 'Danh mục sản phẩm: ' + res.data.name)
                .catch(err => console.log(err))
        }
        const priceInput = $('input[name="price"]');
        priceInput.on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, '')
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            $(this).val(value);
        })
    </script>
    <script>
        function previewFile(event)
        {
            var input = event.target;
            const previewImage = document.getElementById('image-preview')
            const previewVideo = document.getElementById('video-preview')
            const imageIcon = document.getElementById('image-icon')
            const videoIcon = document.getElementById('video-icon')

            const reader = new FileReader();

            reader.onload = function() {
                if (input.files[0].type.startsWith('image/')) {
                    previewImage.style.display = 'block';
                    imageIcon.style.display = 'none';
                    previewImage.src = reader.result;
                } else if (input.files[0].type.startsWith('video/')) {
                    previewVideo.style.display = 'block';
                    videoIcon.style.display = 'none';
                    previewVideo.src = reader.result;
                }
            }

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>