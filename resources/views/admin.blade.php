<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start space-x-8 ml-14">

            <!-- SubCategory Modal -->
            @foreach($categories as $key => $category)
            @if (count($category->subCategories)) 
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

            <!-- Main Modal -->
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
                                <button class="flex items-center justify-between w-full h-12 border border-black px-3 hover:bg-gray-200"
                                    onclick="window.location.href='/admin'">
                                    <span class="text-base font-normal block ml-3">{{ __('Tất cả danh mục') }}</span>
                                </button>
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
            <div class="relative">
                <button class="py-2 px-3 bg-white border border-[rgba(0,0,0,0.5)] rounded-xl inline-flex items-center"
                    data-bs-toggle="modal" data-bs-target="#categoryModal">
                    <span id="category-name" class="block leading-4 font-medium text-2xl px-2">{{ __('Tất cả danh mục')}}</span>
                    <span class="text-2xl block"><i class= "fi fi-sr-caret-down" ></i></span>
                </button>
            </div>

            <div class="relative">
                <button class="bg-[#4ECB71] text-white px-2 py-2 rounded-lg" id="confirm-selected">
                    <i class="i fi-rs-check-circle px-2 text-2xl flex items-center">
                        <span class="not-italic mx-3 w-full block">{{ __('Xác nhận') }}</span>
                    </i>
                </button>
            </div>

            <div class="relative">
                <button class="bg-[#EC1B1B] text-white px-2 py-2 rounded-lg"
                    data-bs-toggle="modal" data-bs-target="#confirmModal" id="delete-selected">
                    <i class="fi fi-rr-trash px-2 text-2xl flex items-center">
                        <span class="not-italic mx-3 w-full block">{{ __('Xóa') }}</span>
                    </i>
                </button>
            </div>
        </div>
    </x-slot>
    <div class="py-10">
        <!-- Confirm modal -->
        <div class="modal" id="confirmModal" role="dialog" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                        <h5 class="modal-title text-xl font-bold" id="confirmModalLabel">Xác nhận xóa sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class= "fi fi-br-cross" ></i>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này không ?</p>
                    </div>
                    <div class="modal-footer">
                        <button id="confirm-btn" type="button" class="px-3 py-2 rounded-md text-white bg-[#007bff] font-semibold border border-gray-500">Xác nhận</button>
                        <button type="button" class="px-3 py-2 rounded-md bg-white border border-gray-500" data-bs-dismiss="modal" aria-label="Close">
                            Hủy bỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-8">
            <table class="w-full text-base text-left rtl:text-right text-black dark:text-gray-400 border border-gray-300 shadow-lg">
                <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400 border-b border-t-0 border-l-0 border-r-0 border border-gray-300">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-center">
                            #
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            STT
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Tên sản phẩm
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Loại
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Thời gian sử dụng
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Giá
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Mô tả
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Ảnh
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Video
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Xác nhận
                        </th>
                        <th scope="col" class="px-3 py-3 text-center">
                            Xóa
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $i => $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input type="checkbox" data-product-id="{{ $product->product_id }}" name="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </td>
                        <td class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $i+1 }}
                        </td>
                        <td class="px-3 py-4">
                            {{ $product->name }}
                        </td>
                        <td class="px-3 py-4">
                            {{ $product->category_by_word }}
                        </td>
                        <td class="px-3 py-4">
                            {{ $product->time_used_by_word }}
                        </td>
                        <td class="px-3 py-4">
                            {{ number_format($product->price , 0, ',', '.') }}đ
                        </td>
                        <td class="px-3 py-4">
                            {{ $product->description }}
                        </td>
                        <td class="px-3 py-4 w-[152px] h-[158px]">
                            <img class="max-w-[138px] max-h-[112px] w-full mx-auto my-auto object-contain"
                                src="{{ $product->thumbnail_image->image_url }}"/>
                        </td>
                        <td class="px-3 py-4">
                            @if($product->videos->count())
                            <video autoplay loop controls name="media" class="d-block max-w-[138px] max-h-[112px] w-full object-contain mx-auto">
                                <source src="{{ $product->videos->first()->video_url }}">
                            </video>
                            @endif
                        </td>
                        <td class="px-3 py-4">
                            <form action="{{ route('admin.product.update', ['product' => $product]) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <button class="hover:text-green-400 text-[#4ECB71]">
                                    <i class="i fi-rs-check-circle px-2 text-2xl"></i>
                                </button>
                            </form>
                        </td>
                        <td class="px-3 py-4">
                            <form id="F{{ $product->product_id }}" action="{{ route('admin.product.destroy', ['product' => $product]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="event.preventDefault();" class="hover:text-red-400 text-[#F24E1E]"
                                data-bs-toggle="modal" data-bs-target="#confirmModal"
                                data-product-id="{{ $product->product_id }}">
                                <i class="fi fi-rr-trash px-2 text-2xl">
                                </i>
                            </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="module">
        const url = new URL(window.location.href);
        const categoryName = document.getElementById('category-name')

        const requestCategoryID = url.searchParams.get('cid')
        if (requestCategoryID)
        {
            axios.get(`/api/categories/${requestCategoryID}`)
                .then(res => categoryName.innerHTML = res.data.name)
                .catch(err => console.log(err))
        }

        $(document).ready(function() {
            $('button.subcategory').click(function () {
                var newCategoryName = $(this).data('name')
                var newCategoryId = $(this).data('id')
                categoryName.innerHTML = newCategoryName
                url.searchParams.set('cid', newCategoryId)
                window.location.href = url
            })
        })
        const confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('shown.bs.modal', event => {
            if (event.relatedTarget.id == 'delete-selected') {
                $('#confirm-btn').click(function() {
                    var checkboxes = $(':checkbox:checked');
                    const productIds = [];
                    checkboxes.each(function() {
                        productIds.push($(this).attr('data-product-id'))
                    })
                    if (productIds.length) {
                        axios.post(
                            '/api/admin/products',
                            {
                                productIds: productIds
                            })
                            .then(res => window.location.reload())
                            .catch(err => console.log(err))
                    }
                })
            } else {
                const productId = event.relatedTarget.getAttribute('data-product-id')
                $('#confirm-btn').click(function() {
                    $('#F' + productId).submit();
                })
            }
        })

        confirmModal.addEventListener('hidden.bs.modal', event => {
            $('#confirm-btn').off()
        })

        $('button#confirm-selected').click(function(){
            var checkboxes = $(':checkbox:checked');
            const productIds = [];
            checkboxes.each(function(){
                productIds.push($(this).attr('data-product-id'))
            })
            if (productIds.length) {
                axios.put(
                '/api/admin/products',
                {
                    productIds: productIds,
                }
                ).then(res => window.location.reload())
                .catch(err => console.log(err))
            }
        })
    </script>
</x-app-layout>