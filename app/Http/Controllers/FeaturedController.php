<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    // GET /featured -> raw PHP এর featured.php (শুধু featured recipe গুলো)
    public function index(Request $request)
    {
        $query = Recipe::with('category');

        if ($request->filled('keyword')) {
            $query->where('recipe_title', 'like', '%' . $request->keyword . '%');
        }

        $recipes = $query->orderBy('last_update', 'desc')->paginate(15);

        return view('featured.index', compact('recipes'));
    }
    // GET /featured/{recipe}/add -> raw PHP এর ?add= লজিক
    public function add(Recipe $recipe)
    {
        $currentFeaturedCount = Recipe::where('featured', 1)->count();

        if ($currentFeaturedCount >= 10) {
            return redirect()->route('featured.index')
                ->with('error', 'You have reached the maximum number of featured recipes!');
        }

        $recipe->update([
            'featured'    => 1,
            'last_update' => now(),
        ]);

        return redirect()->route('featured.index')
            ->with('success', 'Success added to featured recipes');
    }

    public function remove(Recipe $recipe)
    {
        $recipe->update(['featured' => 0]);

        return redirect()->route('featured.index')
            ->with('success', 'Removed from featured recipes');
    }
}
