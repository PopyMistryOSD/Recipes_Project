<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdsPlacement;
use App\Models\AppConfig;
use App\Models\Category;
use App\Models\FcmToken;
use App\Models\Recipe;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeApiController extends Controller
{
    public function checkConnection()
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['status' => 'ok', 'database' => 'connected']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'database' => 'not connected'], 404);
        }
    }

    public function home()
    {
        $limit = 10;

        $category = Category::withCount('recipes')
            ->orderBy('cid', 'desc')->limit($limit)->get();

        $featured = Recipe::with('category')->where('featured', 1)
            ->orderBy('last_update', 'desc')->get();

        $recent = Recipe::with('category')->where('content_type', 'Post')
            ->orderBy('recipe_id', 'desc')->limit($limit)->get();

        $videos = Recipe::with('category')->where('content_type', '!=', 'Post')
            ->orderBy('recipe_id', 'desc')->limit($limit)->get();

        return response()->json([
            'status' => 'ok',
            'featured' => $featured,
            'category' => $category,
            'recent' => $recent,
            'videos' => $videos,
        ]);
    }

    public function recentRecipes(Request $request)
    {
        $limit = (int) $request->input('count', 10);
        $page  = max(1, (int) $request->input('page', 1));
        $type  = $request->input('type', 'all');

        $query = Recipe::with('category');

        match ($type) {
            'post'  => $query->where('content_type', 'Post'),
            'video' => $query->where('content_type', '!=', 'Post'),
            default => null,
        };

        $countTotal = (clone $query)->count();
        $posts = $query->orderBy('recipe_id', 'desc')
            ->forPage($page, $limit)->get();

        return response()->json([
            'status' => 'ok',
            'count' => $posts->count(),
            'count_total' => $countTotal,
            'pages' => $page,
            'posts' => $posts,
        ]);
    }

    public function recipeDetail(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $recipe = Recipe::with(['category', 'gallery'])->find($request->id);

        if (! $recipe) {
            return response()->json(['status' => 'failed', 'message' => 'Recipe not found'], 404);
        }

        $related = Recipe::with('category')
            ->where('recipe_id', '!=', $recipe->recipe_id)
            ->where('cat_id', $recipe->cat_id)
            ->orderBy('recipe_id', 'desc')->limit(5)->get();

        $images = collect([[
            'recipe_id' => $recipe->recipe_id,
            'image_name' => $recipe->recipe_image,
            'content_type' => $recipe->content_type,
            'video_id' => $recipe->video_id,
            'video_url' => $recipe->video_url,
        ]])->merge($recipe->gallery->map(fn ($g) => [
            'recipe_id' => $recipe->recipe_id,
            'image_name' => $g->image_name,
            'content_type' => $recipe->content_type,
            'video_id' => $recipe->video_id,
            'video_url' => $recipe->video_url,
        ]));

        return response()->json([
            'status' => 'ok',
            'post' => $recipe,
            'images' => $images,
            'related' => $related,
        ]);
    }

    public function categoryIndex()
    {
        $categories = Category::withCount('recipes')->orderBy('cid', 'desc')->get();

        return response()->json([
            'status' => 'ok',
            'count' => $categories->count(),
            'categories' => $categories,
        ]);
    }

    public function categoryPosts(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $limit = (int) $request->input('count', 10);
        $page  = max(1, (int) $request->input('page', 1));
        $type  = $request->input('type', 'all');

        $category = Category::find($request->id);

        $query = Recipe::with('category')->where('cat_id', $request->id);

        match ($type) {
            'post'  => $query->where('content_type', 'Post'),
            'video' => $query->where('content_type', '!=', 'Post'),
            default => null,
        };

        $countTotal = (clone $query)->count();
        $posts = $query->orderBy('recipe_id', 'desc')->forPage($page, $limit)->get();

        return response()->json([
            'status' => 'ok',
            'count' => $posts->count(),
            'count_total' => $countTotal,
            'pages' => $page,
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function searchResults(Request $request)
    {
        $request->validate(['search' => 'required|string']);

        $limit = (int) $request->input('count', 10);
        $page  = max(1, (int) $request->input('page', 1));
        $keyword = $request->search;

        $query = Recipe::with('category')
            ->where(function ($q) use ($keyword) {
                $q->where('recipe_title', 'like', "%{$keyword}%")
                  ->orWhere('recipe_description', 'like', "%{$keyword}%");
            });

        $countTotal = (clone $query)->count();
        $posts = $query->orderBy('recipe_id', 'desc')->forPage($page, $limit)->get();

        return response()->json([
            'status' => 'ok',
            'count' => $posts->count(),
            'count_total' => $countTotal,
            'pages' => $page,
            'posts' => $posts,
        ]);
    }

    public function totalViews(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $recipe = Recipe::find($request->id);

        if (! $recipe) {
            return response()->json(['result' => []]);
        }

        $recipe->increment('total_views');

        return response()->json([
            'result' => [[
                'recipe_id' => $recipe->recipe_id,
                'recipe_title' => $recipe->recipe_title,
                'total_views' => $recipe->total_views,
            ]],
        ]);
    }

    public function ads()
    {
        $ad = Ad::find(1);
        $setting = Setting::find(1);

        $merged = collect($ad?->toArray() ?? [])->merge([
            'youtube_api_key' => $setting?->youtube_api_key,
            'fcm_notification_topic' => $setting?->fcm_notification_topic,
            'onesignal_app_id' => $setting?->onesignal_app_id,
            'more_apps_url' => $setting?->more_apps_url,
        ]);

        return response()->json(['status' => 'ok', 'ads' => $merged]);
    }

    public function settings()
    {
        return response()->json(['status' => 'ok', 'post' => Setting::find(1)]);
    }

    public function config(Request $request)
    {
        $settings = Setting::find(1);
        $ads = Ad::find(1);
        $placement = AdsPlacement::find(1);
        $app = AppConfig::where('package_name', $request->package_name)->first();

        return response()->json([
            'status' => 'ok',
            'app' => $app ?? ['package_name' => '', 'status' => '', 'redirect_url' => ''],
            'ads' => $ads,
            'ads_placement' => $placement,
            'settings' => $settings,
        ]);
    }

    public function userToken(Request $request)
    {
        $request->validate(['user_unique_id' => 'required|string']);

        $token = FcmToken::where('user_unique_id', $request->user_unique_id)->first();

        return response()->json(['status' => 'ok', 'response' => $token]);
    }
}
