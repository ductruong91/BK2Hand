<x-guest-layout>
    <!-- Code confirm modal -->
    <div class="modal fade" id="confirmModal" role="dialog" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fi fi-br-cross"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('auth.confirm') }}" method="POST">
                    @csrf
                        <div class="w-full flex flex-col items-center">
                            <div>
                                <x-application-logo class="w-56 h-56 fill-current text-gray-500"/>
                            </div>
                            <input id="email-confirm" type="hidden" name="email" value="{{ old('email') }}"/>
                            <span class="w-full block text-center text-xl">{{ __('Nhập mã bạn vừa nhận để xác nhận') }}</span>
                            <x-text-input id="code" class="block mt-1 w-full" name="code" autofocus />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" id="code-error-message" />
                            <x-primary-button class="ms-3 mt-4 !bg-[#EC1B1B] !text-2xl !font-bold !normal-case !px-4">
                                {{ __('Nhập mã') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <span class="w-full block text-center text-5xl text-[#EC1B1B] font-bold mt-12">{{ __('Xác thực ') }}</span>

    <div class="w-full flex justify-center">
        <x-application-logo class="w-56 h-56 fill-current text-gray-500"/>
    </div>

        <!-- Email Address -->
    <span class="w-full block text-center text-xl">{{ __('Nhập email của bạn để nhận mã xác thực') }}</span>
    <div>
        <x-text-input id="email" class="block mt-1 w-full" name="email" :value="old('email')" autofocus />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="flex items-center justify-center mt-4">
        <x-primary-button id="generate-btn" class="ms-3 !bg-[#EC1B1B] !text-2xl !font-bold !normal-case !px-4" onclick="event.preventDefault();">
            {{ __('Nhận mã') }}
            <div id="spinner" class="spinner-border mx-2" role="status" style="display: none;">
            </div>
        </x-primary-button>
        <button class="hidden" id="trigger-modal" data-bs-toggle="modal" data-bs-target="#confirmModal"></button>
    </div>
    <script type="module">
        
        $('#generate-btn').click(function () {
            $('#spinner').css('display', 'block')
            axios.post('/api/authenticate',
            {
                email: $('#email').val()
            })
            .then(res => {
                $('#spinner').css('display', 'none')
                if (res.data.success)
                {
                    $('#email-confirm').val($('#email').val())
                    $('#trigger-modal').click()
                }
            })
            .catch(err => console.log(err))
        })
    </script>
</x-guest-layout>
