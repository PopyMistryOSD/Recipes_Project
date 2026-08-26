{{-- @extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="flex items-center gap-2 mb-6">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <span class="text-gray-400">></span>
        <span class="text-gray-500">Home</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <a href="{{ route('categories.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">Manage Category</div>
                <div class="text-3xl my-2">📋</div>
                <div class="text-sm">Total {{ $totalCategory }} Categories</div>
            </div>
        </a>

        <a href="{{ route('featured.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">Manage Featured</div>
                <div class="text-3xl my-2">⭐</div>
                <div class="text-sm">Total {{ $totalFeatured }} Featured</div>
            </div>
        </a>

        <a href="{{ route('recipes.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">Manage Recipes</div>
                <div class="text-3xl my-2">🍽️</div>
                <div class="text-sm">Total {{ $totalRecipes }} Recipes</div>
            </div>
        </a>

        <a href="{{ route('ads.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">Manage Ads</div>
                <div class="text-3xl my-2">💰</div>
                <div class="text-sm">App Monetization</div>
            </div>
        </a>

        <a href="{{ route('notifications.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">Notification</div>
                <div class="text-3xl my-2">🔔</div>
                <div class="text-sm">Total {{ $totalFcm }} Templates</div>
            </div>
        </a>

        <a href="{{ route('admins.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">Administrators</div>
                <div class="text-3xl my-2">👥</div>
                <div class="text-sm">Admin Panel Privileges</div>
            </div>
        </a>

        <a href="{{ route('settings.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">Settings</div>
                <div class="text-3xl my-2">⚙️</div>
                <div class="text-sm">Key and Privacy Settings</div>
            </div>
        </a>

        <a href="{{ route('license.index') }}" class="block">
            <div class="bg-blue-600 text-white rounded-lg shadow p-5 hover:bg-blue-700 transition">
                <div class="text-xs uppercase tracking-wide opacity-80">License</div>
                <div class="text-3xl my-2">🔑</div>
                <div class="text-sm">Envato Item Purchase Code</div>
            </div>
        </a>

    </div>
@endsection --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- Dashboard Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-bold text-gray-900">
                    Dashboard
                </h1>

                <span class="text-gray-400">›</span>

                <span class="text-gray-500 text-sm">
                    Home
                </span>
            </div>

            <p class="text-sm text-gray-500 mt-1">
                Welcome back, {{ auth()->user()->name }}!
            </p>
        </div>

    </div>


    {{-- Dashboard Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


        {{-- Category --}}
        <a href="{{ route('categories.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            Manage Category
                        </p>

                        <h3 class="text-2xl font-bold mt-3">
                            {{ $totalCategory }}
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            Total Categories
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            category
                        </span>

                    </div>

                </div>
            </div>

        </a>


        {{-- Featured --}}
        <a href="{{ route('featured.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            Manage Featured
                        </p>

                        <h3 class="text-2xl font-bold mt-3">
                            {{ $totalFeatured }}
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            Total Featured
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            star
                        </span>

                    </div>

                </div>
            </div>

        </a>


        {{-- Recipes --}}
        <a href="{{ route('recipes.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            Manage Recipes
                        </p>

                        <h3 class="text-2xl font-bold mt-3">
                            {{ $totalRecipes }}
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            Total Recipes
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            restaurant
                        </span>

                    </div>

                </div>
            </div>

        </a>


        {{-- Ads --}}
        <a href="{{ route('ads.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            Manage Ads
                        </p>

                        <h3 class="text-lg font-bold mt-3">
                            Monetization
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            App Monetization
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            monetization_on
                        </span>

                    </div>

                </div>
            </div>

        </a>


        {{-- Notification --}}
        <a href="{{ route('notifications.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            Notification
                        </p>

                        <h3 class="text-2xl font-bold mt-3">
                            {{ $totalFcm }}
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            Total Templates
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            notifications
                        </span>

                    </div>

                </div>
            </div>

        </a>


        {{-- Administrators --}}
        <a href="{{ route('admins.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            Administrators
                        </p>

                        <h3 class="text-lg font-bold mt-3">
                            Admin Panel
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            Admin Panel Privileges
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            people
                        </span>

                    </div>

                </div>
            </div>

        </a>


        {{-- Settings --}}
        <a href="{{ route('settings.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            Settings
                        </p>

                        <h3 class="text-lg font-bold mt-3">
                            Settings
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            Key & Privacy Settings
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            settings
                        </span>

                    </div>

                </div>
            </div>

        </a>


        {{-- License --}}
        <a href="{{ route('license.index') }}" class="group">

            <div
                class="bg-blue-600 rounded-lg shadow-sm
                        p-5 text-white
                        transition-all duration-200
                        hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-start justify-between">

                    <div>
                        <p
                            class="text-xs font-medium uppercase
                                  tracking-wide text-blue-100">
                            License
                        </p>

                        <h3 class="text-lg font-bold mt-3">
                            Purchase Code
                        </h3>

                        <p class="text-xs text-blue-100 mt-1">
                            Envato Item Purchase Code
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-lg
                                bg-white/15
                                flex items-center justify-center">

                        <span class="material-icons text-2xl">
                            vpn_key
                        </span>

                    </div>

                </div>
            </div>

        </a>

    </div>

@endsection
