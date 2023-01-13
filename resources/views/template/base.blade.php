<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Scripts -->
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script>
    document.addEventListener('alpine:init' , () => {
        Alpine.data('notif', () =>({
                fetchListNotif(id){
                    this.isLoading = true,
                    fetch(`http://127.0.0.1:8001/api/notif/${id}`)
                    .then(async (response) => {
                        this.datanotif = await response.json()
                        this.isLoading = false

                    })
                },
                datanotif:'',
                colors:'',
                tampilga: true,
                isShow:false,
                coba: 'diah',
                create: false
            }))
    })
    </script>
</head>
<body>
    <nav class="flex items-center justify-between flex-wrap bg-[#2563eb] p-6">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
          <a href="{{ route('notes.index') }}"><svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg></a>
          <a href="{{ route('notes.index') }}"><span class="font-semibold text-xl tracking-tight">Lite Notes</span></a>
        </div>
        <div class="block lg:hidden">
          <button class="flex items-center px-3 py-2 border rounded text-teal-200 text-fuchsia-500 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
          </button>
        </div>
        @auth
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="text-sm lg:flex-grow">
                <a href="{{ route('notes.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:bg-fuchsia-500 mr-4">
                    All Notes
                </a>
                <a href="{{ route('trashed.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:bg-fuchsia-500 mr-4">
                    Trash
                </a>
            </div>
        @endauth

@auth
<div class="relative " x-data="notif">
    <a href="{{ route('notes.index') }}"><img class="w-10 h-10 mr-10" src="{{ asset('gambar/notif.png') }}" alt=""></a>
    <template x-if="datanotif.data == 0 ? isShow : !isShow">
        <div x-init="fetchListNotif({{Auth::user()->id}})"  class="mr-7 ml-2 absolute top-0 right-0 rounded-full bg-red-600 w-7 h-7"><span class="flex justify-center items-center leading-[30px] text-white" x-text="datanotif.data"></span></div>
    </template>
</div>

@endauth

          @guest
          <div class="flex">
            @if (Route::has('login'))
            <div>
                <a href="{{ route('login') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:white hover:bg-fuchsia-500 mt-4 lg:mt-0">Login</a>
            </div>
                @if (Route::has('register'))
                    <div class="mr-5">
                        <a href="{{ route('register') }}" class="ml-5 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:white hover:bg-fuchsia-500 mt-4 lg:mt-0">Register</a>
                    </div>
                @endif
            @endif
          </div>

          @endguest

            @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="text-black inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>


                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
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
            @endauth

        </div>
      </nav>


    <main >
        @yield('content')
    </main>
    @livewireScripts



    {{-- <script>
        setInterval(function() {
            location.reload();
        }, 10000);
    </script> --}}
</body>
</html>
