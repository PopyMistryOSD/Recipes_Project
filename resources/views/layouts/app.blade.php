<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title', 'Admin Panel') - Recipe App</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- Top Bar --}}
    <nav class="bg-white shadow flex items-center justify-between px-4 py-3 fixed top-0 left-0 right-0 z-20">
        <a href="{{ route('dashboard') }}" class="text-lg font-bold text-blue-600 uppercase">
            Recipe App
        </a>

        <div class="flex items-center gap-4">
            <a href="{{ \Illuminate\Support\Facades\Route::has('notifications.index') ? route('notifications.index') : '#' }}"
                class="text-gray-500 hover:text-gray-700">
                <span class="material-icons align-middle">notifications</span>
            </a>

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                    <span class="material-icons align-middle">more_vert</span>
                </button>
                <ul x-show="open" @click.outside="open = false" x-cloak
                    class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg border py-1 text-sm">
                    <li>
                        <a href="{{ \Illuminate\Support\Facades\Route::has('admins.edit') ? route('admins.edit', auth()->id()) : '#' }}"
                            class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                            <span class="material-icons text-base">person</span> Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}"
                            onsubmit="return confirm('Are you sure want to logout?')">
                            @csrf
                            <button type="submit"
                                class="w-full text-left flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                <span class="material-icons text-base">power_settings_new</span> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- #Top Bar --}}

    <div class="flex pt-14">

        {{-- Sidebar --}}
        <aside
            class="w-64 min-h-[calc(100vh-3.5rem)] bg-gray-900 text-gray-300 flex flex-col fixed top-14 left-0 bottom-0">

            {{-- User Info --}}
            <div class="p-4 border-b border-gray-700 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <div class="text-white font-semibold text-sm truncate">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</div>
                </div>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 py-3 overflow-y-auto">
                <p class="px-4 text-xs text-gray-500 uppercase tracking-wide mb-2">Menu</p>
                <ul class="space-y-1">

                    @php
                        $menuLink = function (
                            string $label,
                            string $icon,
                            ?string $routeName = null,
                            bool $active = false,
                        ) {
                            $classes = $active
                                ? 'flex items-center gap-3 px-4 py-2 bg-blue-600 text-white rounded-r-full mr-3'
                                : 'flex items-center gap-3 px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-r-full mr-3';
                            $href =
                                $routeName && \Illuminate\Support\Facades\Route::has($routeName)
                                    ? route($routeName)
                                    : '#';
                            return "<li><a href=\"$href\" class=\"$classes\"><span class=\"material-icons text-lg\">$icon</span><span class=\"text-sm\">$label</span></a></li>";
                        };
                    @endphp

                    {!! $menuLink('Dashboard', 'dashboard', 'dashboard', request()->routeIs('dashboard')) !!}
                    {!! $menuLink('Category', 'view_list', 'categories.index', request()->routeIs('categories.*')) !!}
                    {!! $menuLink('Featured', 'star', 'featured.index', request()->routeIs('featured.*')) !!}
                    {!! $menuLink('Recipes', 'restaurant', 'recipes.index', request()->routeIs('recipes.*')) !!}
                    {!! $menuLink('Ads', 'monetization_on', 'ads.index', request()->routeIs('ads.*')) !!}
                    {!! $menuLink('Notification', 'notifications', 'notifications.index', request()->routeIs('notifications.*')) !!}
                    {!! $menuLink('Administrator', 'people', 'admins.index', request()->routeIs('admins.*')) !!}
                    {!! $menuLink('Settings', 'settings', 'settings.index', request()->routeIs('settings.*')) !!}
                    {!! $menuLink('App', 'adb', 'apps.index', request()->routeIs('apps.*')) !!}
                    {!! $menuLink('License', 'vpn_key', 'license.index', request()->routeIs('license.*')) !!}

                    <li class="border-t border-gray-700 mt-2 pt-2">
                        <form method="POST" action="{{ route('logout') }}"
                            onsubmit="return confirm('Are you sure want to logout?')">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-r-full mr-3">
                                <span class="material-icons text-lg">power_settings_new</span>
                                <span class="text-sm">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            {{-- Footer --}}
            <div class="p-4 border-t border-gray-700 text-xs text-gray-500">
                <div>© {{ date('Y') }} Recipe App</div>
                <div><b>Version:</b> 1.0.0</div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 ml-64">
            <main class="w-full mt-6 px-6 pb-10">
                {{-- <main class="max-w-6xl mx-auto mt-6 px-6 pb-10"> --}}

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')

            </main>
        </div>
    </div>

</body>

</html>
