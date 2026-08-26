@extends('layouts.app')
@section('title', 'Send Notification')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Send Notification</h1>

    <form method="POST" action="{{ route('notifications.send', $notification->id) }}"
        class="bg-white p-6 rounded shadow max-w-xl space-y-4">
        @csrf

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
                <label class="block text-sm mb-1">Image</label>
                <img src="{{ Storage::url($notification->image) }}" class="w-32 h-20 object-cover rounded">
            </div>
        @endif

        <div>
            <label class="block text-sm mb-1">Link (Optional)</label>
            <input type="text" name="link" value="{{ old('link', $notification->link) }}"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <button type="submit" onclick="return confirm('Send this push notification to all users now?')"
                class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                SEND NOW
            </button>
            <a href="{{ route('notifications.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
