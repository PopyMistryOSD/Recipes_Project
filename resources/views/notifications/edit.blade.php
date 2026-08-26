@extends('layouts.app')
@section('title', 'Edit Notification')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Notification</h1>

    <form method="POST" action="{{ route('notifications.update', $notification->id) }}" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow max-w-xl space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $notification->title) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Message</label>
            <input type="text" name="message" value="{{ old('message', $notification->message) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        @if ($notification->image)
            <div>
                <img src="{{ Storage::url($notification->image) }}" class="w-24 h-16 object-cover rounded mb-2">
            </div>
        @endif

        <div>
            <label class="block text-sm mb-1">Replace Image (optional)</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Link (Optional)</label>
            <input type="text" name="link" value="{{ old('link', $notification->link) }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                UPDATE
            </button>
            <a href="{{ route('notifications.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
