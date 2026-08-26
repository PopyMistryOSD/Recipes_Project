@extends('layouts.app')
@section('title', 'Add Recipe')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Recipe</h1>

    <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ type: 'Post' }">
        @csrf

        {{-- Left column --}}
        <div class="space-y-4">

            <div>
                <label class="block text-sm mb-1">Recipe Title</label>
                <input type="text" name="recipe_title" value="{{ old('recipe_title') }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm mb-1">Recipe Time</label>
                <input type="text" name="recipe_time" value="{{ old('recipe_time') }}" placeholder="e.g. 30 mins"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm mb-1">Category</label>
                <select name="cat_id" class="w-full border rounded px-3 py-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->cid }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Content Type</label>
                <select name="upload_type" x-model="type" class="w-full border rounded px-3 py-2">
                    <option value="Post">Recipe Post</option>
                    <option value="youtube">Recipe Video (YouTube)</option>
                    <option value="Url">Recipe Video (Url)</option>
                    <option value="Upload">Recipe Video (Upload)</option>
                </select>
            </div>

            {{-- Post type fields --}}
            <div x-show="type === 'Post'" x-cloak class="space-y-3 border-t pt-3">
                <div>
                    <label class="block text-sm mb-1">Primary Image (jpg/png)</label>
                    <input type="file" name="post_image" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Additional Images (optional, multiple)</label>
                    <input type="file" name="imageoption[]" multiple class="w-full border rounded px-3 py-2">
                </div>
            </div>

            {{-- YouTube type fields --}}
            <div x-show="type === 'youtube'" x-cloak class="border-t pt-3">
                <label class="block text-sm mb-1">YouTube URL</label>
                <input type="text" name="youtube" placeholder="https://www.youtube.com/watch?v=xxxx"
                    class="w-full border rounded px-3 py-2">
            </div>

            {{-- Url type fields --}}
            <div x-show="type === 'Url'" x-cloak class="space-y-3 border-t pt-3">
                <div>
                    <label class="block text-sm mb-1">Thumbnail Image</label>
                    <input type="file" name="image" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Video URL</label>
                    <input type="text" name="url_source" placeholder="http://www.xyz.com/video.mp4"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            {{-- Upload type fields --}}
            <div x-show="type === 'Upload'" x-cloak class="space-y-3 border-t pt-3">
                <div>
                    <label class="block text-sm mb-1">Thumbnail Image</label>
                    <input type="file" name="recipe_image" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Video File</label>
                    <input type="file" name="video" class="w-full border rounded px-3 py-2">
                </div>
            </div>

        </div>

        {{-- Right column: description --}}
        <div>
            <label class="block text-sm mb-1">Description</label>
            <textarea name="recipe_description" rows="16" class="w-full border rounded px-3 py-2">{{ old('recipe_description') }}</textarea>
        </div>

        <div class="md:col-span-2">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                PUBLISH
            </button>
            <a href="{{ route('categories.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
