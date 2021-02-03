<header class="text-gray-700 body-font border-b">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
            <a href="{{ route('home') }}" class="mr-5 hover:text-gray-900">Home</a>
        </nav>
        <a class="flex order-first lg:order-none lg:w-1/5 title-font font-bold items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0">
            BLOG
        </a>

        @if (Route::has('login'))
        <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
            @auth
            <a href="{{ route('posts.index') }}" class="inline-flex items-center bg-gray-200 border-0 py-1 px-3 focus:outline-none hover:bg-gray-300 rounded text-base mt-4 md:mt-0">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="inline-flex items-center bg-gray-200 border-0 py-1 px-3 focus:outline-none hover:bg-gray-300 rounded text-base mt-4 mr-4 md:mt-0">Login</a>
            <a href="{{ route('register') }}" class="inline-flex items-center bg-gray-200 border-0 py-1 px-3 focus:outline-none hover:bg-gray-300 rounded text-base mt-4 md:mt-0">Register</a>
            @endif
        </div>
        @endif
    </div>
</header>