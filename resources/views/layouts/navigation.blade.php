<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    <link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}
    <title>AttractieStats</title>
</head>
<body class="bg-[#1E1E1E] text-white">

    <!-- ✅ Navbar -->
    <nav class="bg-[#1F1F1F] text-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold">AttractieStats</a>

        <div class="lg:hidden">
            <button id="menu-toggle" class="focus:outline-none">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <ul class="hidden lg:flex space-x-8 items-center">
            <li><a href="/" class="hover:text-gray-300">{{ __('navigation.home') }}</a></li>
            <li><a href="/parks" class="hover:text-gray-300">{{ __('navigation.parks') }}</a></li>
            <li><a href="/profile" class="hover:text-gray-300">{{ __('navigation.profile') }}</a></li>
            <li><a href="/gebruikers" class="hover:text-gray-300">{{ __('navigation.users') }}</a></li>
            <li><a href="/friends" class="hover:text-gray-300">{{ __('navigation.friends') }}</a></li>
            @if(auth()->user() && auth()->user()->hasRole('Admin'))
                <li><a href="/admin/attractions" class="hover:text-red-400">{{ __('navigation.admin_attractions') }}</a></li>
            @endif
            <li>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-red-400">{{ __('navigation.logout') }}</button>
                </form>
            </li>
        </ul>
    </div>

    <div id="mobile-menu" class="hidden lg:hidden px-6 pb-4 bg-[#1F1F1F] border-t border-gray-700">
        <ul class="flex flex-col space-y-3 mt-2">
            <li><a href="/" class="block py-2 hover:bg-gray-700 rounded">🏠 {{ __('navigation.home') }}</a></li>
            <li><a href="/parks" class="block py-2 hover:bg-gray-700 rounded">🎡 {{ __('navigation.parks') }}</a></li>
            <li><a href="/profile" class="block py-2 hover:bg-gray-700 rounded">👤 {{ __('navigation.profile') }}</a></li>
            <li><a href="/gebruikers" class="block py-2 hover:bg-gray-700 rounded">👥 {{ __('navigation.users') }}</a></li>
            <li><a href="/friends" class="block py-2 hover:bg-gray-700 rounded">🧑‍🤝‍🧑 {{ __('navigation.friends') }}</a></li>
            @if(auth()->user() && auth()->user()->hasRole('Admin'))
                <li><a href="/admin/attractions" class="block py-2 hover:bg-red-700 rounded">🛠️ {{ __('navigation.admin_attractions') }}</a></li>
            @endif
            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 hover:bg-red-600 rounded">🚪 {{ __('navigation.logout') }}</button>
                </form>
            </li>
        </ul>
    </div>
</nav>



    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
