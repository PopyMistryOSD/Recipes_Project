@extends('layouts.app')
@section('title', 'Recipes')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Recipes</h1>
        <a href="{{ route('recipes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Recipe
        </a>
    </div>

    <table class="w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="text-left p-3">Image</th>
                <th class="text-left p-3">Title</th>
                <th class="text-left p-3">Category</th>
                <th class="text-left p-3">Type</th>
                <th class="text-right p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recipes as $recipe)
                <tr class="border-t">
                    <td class="p-3">
                        @if ($recipe->recipe_image)
                            <img src="{{ Storage::url($recipe->recipe_image) }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-400 text-sm">—</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $recipe->recipe_title }}</td>
                    <td class="p-3">{{ $recipe->category->category_name ?? '-' }}</td>
                    <td class="p-3">{{ $recipe->content_type }}</td>
                    {{-- <td class="p-3 text-right space-x-2">
                        <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('recipes.destroy', $recipe->recipe_id) }}" class="inline"
                            onsubmit="return confirm('Delete this recipe?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td> --}}
                    {{-- <td class="p-3 text-right space-x-2">
                        <a href="{{ route('recipes.edit', $recipe->recipe_id) }}"
                            class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('recipes.destroy', $recipe->recipe_id) }}" class="inline"
                            onsubmit="return confirm('Delete this recipe?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td> --}}
                    <td class="p-3 text-right">
                        <div class="inline-flex gap-2">
                            <a href="{{ route('recipes.edit', $recipe->recipe_id) }}"
                                class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded hover:bg-blue-700 transition">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('recipes.destroy', $recipe->recipe_id) }}"
                                onsubmit="return confirm('Delete this recipe?')">
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
                    <td colspan="5" class="p-6 text-center text-gray-400">No recipes found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $recipes->links() }}</div>
@endsection
