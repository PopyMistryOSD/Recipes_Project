@extends('layouts.app')
@section('title', 'Manage Notification')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manage Notification</h1>
        <a href="{{ route('notifications.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            + ADD NEW NOTIFICATION
        </a>
    </div>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search..."
            class="border rounded px-3 py-2 flex-1">
        <a href="{{ route('notifications.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded text-sm">RESET</a>
        <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Search</button>
    </form>

    @if ($templates->isEmpty())
        <p class="text-center text-gray-500 py-10">There are no notification templates.</p>
    @else
        <table class="w-full bg-white rounded shadow overflow-hidden text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="text-left p-3">Title</th>
                    <th class="text-left p-3">Image</th>
                    <th class="text-left p-3">Message</th>
                    <th class="text-left p-3">Url</th>
                    <th class="text-right p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $template)
                    <tr class="border-t">
                        <td class="p-3">{{ $template->title }}</td>
                        <td class="p-3">
                            @if ($template->image)
                                <img src="{{ Storage::url($template->image) }}" class="w-16 h-10 object-cover rounded">
                            @endif
                        </td>
                        <td class="p-3">{{ Str::limit($template->message, 60) }}</td>
                        <td class="p-3">{{ $template->link ? Str::limit($template->link, 50) : 'none' }}</td>
                        <td class="p-3 text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('notifications.send.form', $template->id) }}"
                                    class="bg-green-600 text-white text-sm px-3 py-1.5 rounded hover:bg-green-700 transition"
                                    title="Send">
                                    <span class="material-icons text-sm align-middle">notifications_active</span>
                                </a>
                                <a href="{{ route('notifications.edit', $template->id) }}"
                                    class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded hover:bg-blue-700 transition">
                                    Edit
                                </a>
                                <a href="{{ route('notifications.destroy', $template->id) }}"
                                    onclick="return confirm('Are you sure want to delete this notification?')"
                                    class="bg-red-600 text-white text-sm px-3 py-1.5 rounded hover:bg-red-700 transition">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $templates->appends(request()->query())->links() }}</div>
    @endif
@endsection
