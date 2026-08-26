@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

    <form method="POST" action="{{ route('categories.update', $category->cid) }}" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm mb-1">Category Name</label>
            <input type="text" name="category_name" value="{{ old('category_name', $category->category_name) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        @if ($category->category_image)
            <div class="mb-4">
                <img src="{{ Storage::url($category->category_image) }}" class="w-20 h-20 object-cover rounded mb-2">
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-sm mb-1">Change Image (optional)</label>
            <input type="file" name="category_image" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="featured" value="1" @checked($category->featured)>
                <span class="ml-2 text-sm">Featured Category</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Category
        </button>
        <a href="{{ route('categories.index') }}" class="ml-2 text-gray-500">Cancel</a>
    </form>
@endsection
