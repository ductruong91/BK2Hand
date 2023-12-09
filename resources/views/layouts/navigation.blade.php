<nav x-data="{ open: false }" class="bg-[#F40D0D] dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('homepage') }}">
                        <x-application-logo class="block h-16 w-auto fill-current text-white dark:text-gray-200" />
                    </a>
                </div>

                <button class="h-[55px] shrink-0 self-center ml-10 text-lg w-[122px] flex justify-center bg-white py-3 px-4 rounded-lg">
                    <span class="block">{{ __('Danh mục') }}</span>
                </button>
            </div>

            <div class="flex items-center">
                <form action="{{ route('product.search') }}" method="GET">
                    <div class="flex items-center py-2 px-4 border border-gray-700 bg-white rounded-full">
                        <input name="keyword" type="text" placeholder="Search something..." 
                            class="border-none focus:ring-0 focus:ring-offset-0 w-[500px]"
                            value="{{ request('keyword') }}"/>
                        <button class="text-2xl hover:text-gray-600">
                            <i class="fi fi-bs-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right content -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-5">
                <div>
                    <button class="flex items-center bg-white shadow-sm py-3 px-2.5 rounded-lg">
                        <span class="mr-2 text-2xl flex items-center justify-center"><i class="fi fi-bs-plus"></i></span>
                        <span class="text-2xl font-bold block">{{ __('Đăng bài') }}</span>
                    </button>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <a class="block mx-3">
                            <img src="{{ Auth::user()->avatar }}" class=" h-[76px] w-[76px] object-scale-down"/>
                        </a>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
