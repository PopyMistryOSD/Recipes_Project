@extends('layouts.app')
@section('title', 'Add New Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add New Admin</h1>

    <form method="POST" action="{{ route('admins.store') }}" class="bg-white p-6 rounded shadow max-w-lg space-y-4">
        @csrf

        <div>
            <label class="block text-sm mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="w-full border rounded px-3 py-2"
                required>
        </div>

        <div>
            <label class="block text-sm mb-1">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full border rounded px-3 py-2"
                required>
        </div>

        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2"
                required>
        </div>

        <div>
            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Re Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                SUBMIT
            </button>
            <a href="{{ route('admins.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
