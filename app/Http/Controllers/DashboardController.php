<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NotificationTemplate;
use App\Models\Recipe;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalRecipes  = Recipe::count();
        $totalFeatured = Recipe::where('featured', 1)->count();
        $totalFcm      = NotificationTemplate::count();

        return view('dashboard', compact(
            'totalCategory', 'totalRecipes', 'totalFeatured', 'totalFcm'
        ));
    }
}
