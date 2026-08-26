@extends('layouts.app')
@section('title', 'Categories')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Categories</h1>
        <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Category
        </a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search category..."
            class="border rounded px-3 py-2 w-64">
        <button class="bg-gray-700 text-white px-4 py-2 rounded">Search</button>
    </form>

    <table class="w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="text-left p-3">Image</th>
                <th class="text-left p-3">Name</th>
                <th class="text-left p-3">Featured</th>
                <th class="text-left p-3">Recipes</th>
                <th class="text-right p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr class="border-t">
                    <td class="p-3">
                        @if ($category->category_image)
                            <img src="{{ Storage::url($category->category_image) }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-400 text-sm">No image</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $category->category_name }}</td>
                    <td class="p-3">
                        @if ($category->featured)
                            <span class="text-green-600 font-semibold">Yes</span>
                        @else
                            <span class="text-gray-400">No</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $category->recipes()->count() }}</td>
                    {{-- <td class="p-3 text-right space-x-2">
                        <a href="{{ route('categories.edit', $category->cid) }}"
                           class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', $category->cid) }}"
                              class="inline" onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td> --}}
                    <td class="p-3 text-right">
                        <div class="inline-flex gap-2">
                            <a href="{{ route('categories.edit', $category->cid) }}"
                                class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded hover:bg-blue-700 transition">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('categories.destroy', $category->cid) }}"
                                onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white text-sm px-3 py-1.5 rounded hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-400">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
@endsection
