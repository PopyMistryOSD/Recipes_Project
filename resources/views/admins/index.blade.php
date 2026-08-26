@extends('layouts.app')
@section('title', 'Manage Admin')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manage Admin</h1>
        <a href="{{ route('admins.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            + ADD NEW ADMIN
        </a>
    </div>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search..."
            class="border rounded px-3 py-2 flex-1">
        <a href="{{ route('admins.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded text-sm">RESET</a>
        <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Search</button>
    </form>

    @if ($admins->isEmpty())
        <p class="text-center text-gray-500 py-10">There are no admins.</p>
    @else
        <table class="w-full bg-white rounded shadow overflow-hidden text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="text-left p-3">Username</th>
                    <th class="text-left p-3">Full Name</th>
                    <th class="text-left p-3">Email</th>
                    <th class="text-right p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr class="border-t">
                        <td class="p-3">
                            <span
                                class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">{{ $admin->username }}</span>
                        </td>
                        <td class="p-3">{{ $admin->name }}</td>
                        <td class="p-3">{{ $admin->email }}</td>
                        <td class="p-3 text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admins.edit', $admin->id) }}"
                                    class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded hover:bg-blue-700 transition">
                                    Edit
                                </a>
                                @if ($admin->id !== 1)
                                    <a href="{{ route('admins.destroy', $admin->id) }}"
                                        onclick="return confirm('Are you sure want to delete this user?')"
                                        class="bg-red-600 text-white text-sm px-3 py-1.5 rounded hover:bg-red-700 transition">
                                        Delete
                                    </a>
                                @endif
                            </div>

                            {{-- admin deleted option --}}

                            {{-- <div class="inline-flex gap-2">
                                <a href="{{ route('admins.edit', $admin->id) }}"
                                    class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded hover:bg-blue-700 transition">
                                    Edit
                                </a>
                                <a href="{{ route('admins.destroy', $admin->id) }}"
                                    onclick="return confirm('Are you sure want to delete this user?')"
                                    class="bg-red-600 text-white text-sm px-3 py-1.5 rounded hover:bg-red-700 transition">
                                    Delete
                                </a>
                            </div> --}}


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $admins->appends(request()->query())->links() }}</div>
    @endif
@endsection
