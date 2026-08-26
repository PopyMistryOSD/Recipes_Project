@extends('layouts.app')
@section('title', 'Add Notification')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Notification</h1>

    <form method="POST" action="{{ route('notifications.store') }}" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow max-w-xl space-y-4">
        @csrf

        <div>
            <label class="block text-sm mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Message</label>
            <input type="text" name="message" value="{{ old('message') }}" class="w-full border rounded px-3 py-2"
                required>
        </div>

        <div>
            <label class="block text-sm mb-1">Image (JPG, JPEG, PNG or GIF)</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Link (Optional)</label>
            <input type="text" name="link" value="{{ old('link') }}" placeholder="https://google.com"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                SUBMIT
            </button>
            <a href="{{ route('notifications.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
