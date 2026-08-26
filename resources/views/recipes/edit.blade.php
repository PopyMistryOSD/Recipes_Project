@extends('layouts.app')
@section('title', 'Edit Recipe')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Recipe</h1>

    <form method="POST" action="{{ route('recipes.update', $recipe->recipe_id) }}" enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ type: '{{ old('upload_type', $recipe->content_type) }}' }">
        @csrf
        @method('PUT')

        <div class="space-y-4">

            <div>
                <label class="block text-sm mb-1">Recipe Title</label>
                <input type="text" name="recipe_title" value="{{ old('recipe_title', $recipe->recipe_title) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm mb-1">Recipe Time</label>
                <input type="text" name="recipe_time" value="{{ old('recipe_time', $recipe->recipe_time) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm mb-1">Category</label>
                <select name="cat_id" class="w-full border rounded px-3 py-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->cid }}" @selected($category->cid == $recipe->cat_id)>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Content Type</label>
                <select name="upload_type" x-model="type" class="w-full border rounded px-3 py-2">
                    <option value="Post" @selected($recipe->content_type === 'Post')>Recipe Post</option>
                    <option value="youtube" @selected($recipe->content_type === 'youtube')>Recipe Video (YouTube)</option>
                    <option value="Url" @selected($recipe->content_type === 'Url')>Recipe Video (Url)</option>
                    <option value="Upload" @selected($recipe->content_type === 'Upload')>Recipe Video (Upload)</option>
                </select>
            </div>

            @if ($recipe->recipe_image)
                <div>
                    <label class="block text-sm mb-1">Current Thumbnail</label>
                    <img src="{{ Storage::url($recipe->recipe_image) }}" class="w-24 h-24 object-cover rounded">
                </div>
            @endif

            {{-- Post type fields --}}
            <div x-show="type === 'Post'" x-cloak class="space-y-3 border-t pt-3">
                <div>
                    <label class="block text-sm mb-1">Replace Primary Image (optional)</label>
                    <input type="file" name="post_image" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Add More Gallery Images (optional)</label>
                    <input type="file" name="imageoption[]" multiple class="w-full border rounded px-3 py-2">
                </div>

                @if ($recipe->gallery->count())
                    <div class="flex flex-wrap gap-2">
                        @foreach ($recipe->gallery as $img)
                            <img src="{{ Storage::url($img->image_name) }}" class="w-16 h-16 object-cover rounded">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- YouTube type fields --}}
            <div x-show="type === 'youtube'" x-cloak class="border-t pt-3">
                <label class="block text-sm mb-1">YouTube URL</label>
                <input type="text" name="youtube"
                    value="{{ old('youtube', $recipe->content_type === 'youtube' ? $recipe->video_url : '') }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            {{-- Url type fields --}}
            <div x-show="type === 'Url'" x-cloak class="space-y-3 border-t pt-3">
                <div>
                    <label class="block text-sm mb-1">Replace Thumbnail (optional)</label>
                    <input type="file" name="image" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Video URL</label>
                    <input type="text" name="url_source"
                        value="{{ old('url_source', $recipe->content_type === 'Url' ? $recipe->video_url : '') }}"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            {{-- Upload type fields --}}
            <div x-show="type === 'Upload'" x-cloak class="space-y-3 border-t pt-3">
                <div>
                    <label class="block text-sm mb-1">Replace Thumbnail (optional)</label>
                    <input type="file" name="recipe_image" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Replace Video (optional)</label>
                    <input type="file" name="video" class="w-full border rounded px-3 py-2">
                </div>
            </div>

        </div>

        <div>
            <label class="block text-sm mb-1">Description</label>
            <textarea name="recipe_description" rows="16" class="w-full border rounded px-3 py-2">{{ old('recipe_description', $recipe->recipe_description) }}</textarea>
        </div>

        <div class="md:col-span-2">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                UPDATE
            </button>
            <a href="{{ route('categories.index') }}"
                class="ml-2 bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 inline-block transition">
                Cancel
            </a>
        </div>
    </form>
@endsection
