<div class="flex flex-wrap place-items-center sticky top-0 z-50">
    <section class="relative mx-auto">

        <nav>
            <div class="flex justify-between bg-gray-900 text-white w-screen">
                <div class="px-5 xl:px-12 py-6 flex w-full items-center">
                    <a id="logo" class="text-3xl font-bold font-heading" href="{{ url('/') }}">
                        {{ config('app.name', 'CyDocs') }}
                    </a>
                    <!-- Nav Links -->
                    <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
                        @guest
                            <li><a class="hover:text-gray-200" href="{{ route('login') }}">Login</a></li>
                            @if (Route::has('register'))
                                <li><a class="hover:text-gray-200" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @else
                            <li><a class="hover:text-gray-200" href="{{ route('home') }}">Home</a></li>
                            <li><a class="hover:text-gray-200" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>

                    </ul>

                </div>
                @endguest

                <a class="self-center mr-12 md:hidden" id="navbar-burger">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </a>

                <div class="hidden flex items-center justify-center py-4" id="">
                    <div class="sm:flex sm:items-center">
                        <ul class="">
                            <li><a href="{{ route('home') }}" class="block text-sm px-2 py-4 text-white font-semibold">Home</a></li>
                            <li><a href="{{ route('logout') }}" class="block text-sm px-2 py-4 hover:bg-indigo-500 transition duration-300"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>
</div>
