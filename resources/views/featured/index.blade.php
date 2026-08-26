@extends('layouts.app')
@section('title', 'Featured Recipes')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manage Featured</h1>
        <a href="{{ route('recipes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            ADD NEW RECIPES
        </a>
    </div>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search..."
            class="border rounded px-3 py-2 flex-1">
        <a href="{{ route('featured.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded text-sm">RESET</a>
        <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Search</button>
    </form>

    @if ($recipes->isEmpty())
        <p class="text-center text-gray-500 py-10">There are no featured recipes.</p>
    @else
        <table class="w-full bg-white rounded shadow overflow-hidden text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="text-left p-3">Recipe Name</th>
                    <th class="text-left p-3">Image</th>
                    <th class="text-left p-3">Time</th>
                    <th class="text-left p-3">Category</th>
                    <th class="text-center p-3">Featured</th>
                    <th class="text-center p-3">Views</th>
                    <th class="text-center p-3">Type</th>
                    <th class="text-center p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recipes as $recipe)
                    <tr class="border-t">
                        <td class="p-3">{{ $recipe->recipe_title }}</td>

                        <td class="p-3">
                            @if ($recipe->content_type === 'youtube')
                                <img src="https://img.youtube.com/vi/{{ $recipe->video_id }}/mqdefault.jpg"
                                    class="w-20 h-14 object-cover rounded">
                            @elseif ($recipe->recipe_image)
                                <img src="{{ Storage::url($recipe->recipe_image) }}" class="w-20 h-14 object-cover rounded">
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>

                        <td class="p-3">{{ $recipe->recipe_time }}</td>
                        <td class="p-3">{{ $recipe->category->category_name ?? '-' }}</td>

                        <td class="p-3 text-center">
                            @if ($recipe->featured)
                                <a href="{{ route('featured.remove', $recipe->recipe_id) }}"
                                    onclick="return confirm('Remove from featured recipes?')"
                                    class="inline-block text-blue-500 text-2xl leading-none"
                                    title="Remove from featured">●</a>
                            @else
                                <a href="{{ route('featured.add', $recipe->recipe_id) }}"
                                    onclick="return confirm('Add to featured recipes?')"
                                    class="inline-block text-gray-400 text-2xl leading-none" title="Add to featured">●</a>
                            @endif
                        </td>

                        <td class="p-3 text-center">{{ $recipe->total_views }}</td>

                        <td class="p-3 text-center">
                            @if ($recipe->content_type === 'Post')
                                <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">RECIPE</span>
                            @else
                                <span class="bg-orange-500 text-white text-xs px-2 py-1 rounded-full">VIDEO</span>
                            @endif
                        </td>

                        <td class="p-3">
                            <div class="flex justify-center gap-3 text-gray-500">
                                <a href="#" title="Send Notification" class="hover:text-blue-600">
                                    <span class="material-icons text-lg">notifications_active</span>
                                </a>
                                <a href="#" title="View Details" class="hover:text-blue-600">
                                    <span class="material-icons text-lg">launch</span>
                                </a>
                                <a href="{{ route('recipes.edit', $recipe->recipe_id) }}" title="Edit"
                                    class="hover:text-blue-600">
                                    <span class="material-icons text-lg">mode_edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $recipes->appends(request()->query())->links() }}</div>
    @endif
@endsection
