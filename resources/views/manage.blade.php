<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-[32px] left-[135px] py-2">Bài viết đã đăng</h1>
        <div class="flex items-start space-x-8">

            <div class="relative" >
                <button onclick="window.location.href = '{{ route('user.product') }}'" class="py-3 px-3 @if(request('status') != '0' && request('status') != '1') bg-[#F40D0DC2] @else bg-white @endif border border-[rgba(0,0,0,0.5)] rounded-md inline-flex items-center">
                    <span id="onclick" class="block leading-4 @if(request('status') != '0' && request('status') != '1') text-white font-bold @else font-medium @endif text-2xl px-2">{{ __('Tất cả sản phẩm')}}</span>
                </button>
            </div>
            <div class="relative" >
                <button onclick="window.location.href = '{{ route('user.product', ['status' => '0']) }}'" class="py-3 px-3 @if(request('status') == '0') bg-[#F40D0DC2] @else bg-white @endif border border-[rgba(0,0,0,0.5)] rounded-md inline-flex items-center">
                    <span id="onclick" class="block leading-4 @if(request('status') == '0') text-white font-bold @else font-medium @endif text-2xl px-2">{{ __('Sản phẩm chưa bán') }}</span>
                </button>
            </div>

            <div class="relative" >
                <button onclick="window.location.href = '{{ route('user.product', ['status' => '1']) }}'" class="py-3 px-3 @if(request('status') == '1') bg-[#F40D0DC2] @else bg-white @endif border border-[rgba(0,0,0,0.5)] rounded-md inline-flex items-center">
                    <span id="onclick" class="block leading-4 @if(request('status') == '1') text-white font-bold @else font-medium @endif text-2xl px-2">{{ __('Sản phẩm đã bán') }}</span>
                </button>
            </div>

            <script>
            </script>
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="product-list" class="grid grid-cols-1 gap-y-8">
                @foreach($products as $product)
                <div id="{{ $product->product_id }}" class="max-w-[780px] w-full flex justify-center">
                    <div class="flex items-center py-5 px-5 bg-white rounded-2xl border border-[#897272] max-w-[780px] w-full">
                        <div class="w-[174px] h-[156px] flex items-center flex-shrink-0">
                            <img class="max-w-full max-h-full mx-auto my-auto w-full object-contain" 
                                src="{{ $product->thumbnail_image->image_url }}"/>
                        </div>
                        <div class="flex ml-2 flex-col flex-shrink-0">
                            <span class="text-2xl block">
                                {{ $product->name }}
                            </span>
                            <span class="text-lg text-[#EC1B1B]">
                                {{ number_format($product->price , 0, ',', '.') }}đ
                            </span>
                            <span class="text-lg text-black">
                                Danh mục: <span>{{ $product->category_by_word }}</span>
                            </span>
                            <span class="text-lg text-black">
                                Thời gian sử dụng: <span>{{ $product->time_used_by_word }}</span>
                            </span>
                        </div>
                        <div class="w-full flex justify-end">
                            <div class="flex ml-20 flex-col items-center py-3 space-y-6 mr-4">
                                @if($product->status == '0')
                                <form action="{{ route('product.update', ['product' => $product]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <button id="U{{ $product->product_id }}" class="update-btn bg-[#4ECB71] text-white w-[172px] px-2 py-2 rounded-lg">
                                        <i class="i fi-rs-check-circle px-2 text-2xl flex items-center">
                                            <span class="not-italic mx-3 w-full block">{{ __('Đã bán') }}</span>
                                        </i>
                                    </button>
                                </form>
                                @endif
                                <form id="F{{ $product->product_id }}" action="{{ route('product.update', ['product' => $product]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="event.preventDefault();" id="D{{ $product->product_id }}" class="delete-btn bg-[#EC1B1B] text-white w-[172px] px-2 py-2 rounded-lg"
                                    data-bs-toggle="modal" data-bs-target="#confirmModal">
                                    <i class="fi fi-rr-trash px-2 text-2xl flex items-center">
                                        <span class="not-italic mx-3 w-full block">{{ __('Xóa') }}</span>
                                    </i>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
            <div class="mt-6">
                {{ $products->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>

    <script type="module">
        // const template = document.getElementById('product-card');
        // const list = document.getElementById('product-list')

        // axios.get('/api/user/products')
        //     .then(res => {
        //         const products = res.data.data.data;
        //         console.log(products)
        //         for (const product of products) {
        //             var clone = document.importNode(template.content, true);
        //             clone.querySelector('img').src = product.images[0];
        //             clone.querySelector('#product-name').textContent = product.name;
        //             clone.querySelector('#product-thumbnail').src = product.images[0].image_url;
        //             clone.querySelector('#product-price').textContent = product.price;
        //             clone.querySelector('#product-category-name').textContent = product.category_by_word;
        //             clone.querySelector('#product-time-used').textContent = product.time_used_by_word;
        //             list.appendChild(clone)
        //         }
        //     })
        //     .catch(err => console.log(err))
        // const updateBtns = document.querySelectorAll('.update-btn')
        // const url = new URL(window.location.href);
        // updateBtns.forEach(element => element.addEventListener('click', () => {
        //     const product_id = element.getAttribute('id').slice(1)
        //     axios.put('/api/user/products/' + product_id)
        //         .then(res => {
        //             element.style.display = 'none';
        //             if (url.searchParams.get('status') == '0')
        //                 document.getElementById(product_id).style.display = 'none'
        //         })
        //         .catch(err => console.log(err))
        // }))
        // document.querySelectorAll('.delete-btn').forEach(
        //     element => element.addEventListener('click', 
        //     () => {
        //         const product_id = element.getAttribute('id').slice(1)
        //         axios.delete('/api/user/products/' + product_id)
        //             .then(res => {
        //                 document.getElementById(product_id).style.display = 'none'
        //             })
        //             .catch(err => console.log(err))
        //     })
        // )
        const confirmModal = document.getElementById('confirmModal')
        confirmModal.addEventListener('show.bs.modal', event => {
            const product_id = event.relatedTarget.id.slice(1);
            $('#confirm-btn').click(function () {
                $('#F' + product_id).submit();
            })
        })

        confirmModal.addEventListener('hidden.bs.modal', event => {
            $('#confirm-btn').off();
        })
    </script>
</x-app-layout>
