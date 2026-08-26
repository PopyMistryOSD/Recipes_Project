@extends('layouts.app')
@section('title', 'Add App')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add App</h1>

    <form method="POST" action="{{ route('apps.store') }}" class="bg-white p-6 rounded shadow max-w-xl space-y-4"
        x-data="{ status: 'active' }">
        @csrf

        <div>
            <label class="block text-sm mb-1">applicationId (Package Name)</label>
            <input type="text" name="package_name" value="{{ old('package_name') }}" placeholder="com.domain.appname"
                class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Status</label>
            <select name="status" x-model="status" class="w-full border rounded px-3 py-2">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div x-show="status === 'inactive'" x-cloak>
            <label class="block text-sm mb-1">Redirect Url (Optional)</label>
            <input type="text" name="redirect_url" value="{{ old('redirect_url') }}"
                placeholder="https://play.google.com/store/apps/details?id=com.app.yourrecipeapp"
                class="w-full border rounded px-3 py-2">
            <p class="text-xs text-blue-600 mt-1">Redirect url is only used if app status is inactive</p>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                SUBMIT
            </button>
            <a href="{{ route('apps.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
