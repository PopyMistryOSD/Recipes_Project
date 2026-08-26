<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\RecipeGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    // GET /recipes -> raw PHP এর recipes.php
    public function index(Request $request)
    {
        $query = Recipe::with('category');

        if ($request->filled('search')) {
            $query->where('recipe_title', 'like', '%' . $request->search . '%');
        }

        $recipes = $query->orderBy('recipe_id', 'desc')->paginate(15);

        return view('recipes.index', compact('recipes'));
    }

    // GET /recipes/create -> raw PHP এর recipes-add.php (ফর্ম অংশ)
    public function create()
    {
        $categories = Category::orderBy('cid', 'desc')->get();
        return view('recipes.create', compact('categories'));
    }


    // POST /recipes -> raw PHP এর recipes-add.php (submit লজিক)
    public function store(Request $request)
    {
        $request->validate([
            'cat_id'              => 'required|exists:categories,cid',
            'recipe_title'        => 'required|string|max:255',
            'recipe_time'         => 'required|string|max:100',
            'recipe_description'  => 'required|string',
            'upload_type'         => 'required|in:Post,youtube,Url,Upload',

            'post_image'          => 'required_if:upload_type,Post|nullable|image|max:8192',
            'imageoption.*'       => 'nullable|image|max:8192',
            'youtube'             => 'nullable|required_if:upload_type,youtube|string',
            'image'               => 'required_if:upload_type,Url|nullable|image|max:8192',
            'url_source'          => 'nullable|required_if:upload_type,Url|string',
            'recipe_image'        => 'required_if:upload_type,Upload|nullable|image|max:8192',
            'video'               => 'required_if:upload_type,Upload|nullable|file|mimes:mp4,mov,wmv,mkv,3gp,m4v,flv|max:512000',
        ]);

        $videoUrl   = null;
        $videoId    = 'cda11up';   // raw PHP এর ডিফল্ট মান
        $recipeImage = null;
        $size       = null;
        $galleryImages = [];

        switch ($request->upload_type) {

            case 'Upload':
                $recipeImage = $request->file('recipe_image')->store('recipes', 'public');
                $videoPath   = $request->file('video')->store('recipes/videos', 'public');
                $videoUrl    = $videoPath;
                $size        = $this->formatBytes($request->file('video')->getSize());
                break;

            case 'Url':
                $videoUrl    = $request->url_source;
                $recipeImage = $request->file('image')->store('recipes', 'public');
                break;

            case 'Post':
                $recipeImage = $request->file('post_image')->store('recipes', 'public');

                if ($request->hasFile('imageoption')) {
                    foreach ($request->file('imageoption') as $file) {
                        $galleryImages[] = $file->store('recipes/gallery', 'public');
                    }
                }
                break;

            case 'youtube':
                $videoUrl = $request->youtube;
                $videoId  = $this->extractYoutubeId($request->youtube) ?: $videoId;
                break;
        }

        $recipe = Recipe::create([
            'cat_id'              => $request->cat_id,
            'recipe_title'        => $request->recipe_title,
            'video_url'           => $videoUrl,
            'video_id'            => $videoId,
            'recipe_image'        => $recipeImage,
            'recipe_time'         => $request->recipe_time,
            'recipe_description'  => $request->recipe_description,
            'content_type'        => $request->upload_type,
            'size'                => $size,
        ]);

        foreach ($galleryImages as $imageName) {
            RecipeGallery::create([
                'recipe_id'  => $recipe->recipe_id,
                'image_name' => $imageName,
            ]);
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe added successfully!');
    }

    // ---- Helper methods ----

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)       return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' bytes';
    }

    private function extractYoutubeId(string $url): ?string
    {
        $pattern = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})$%x';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->recipe_image) {
            Storage::disk('public')->delete($recipe->recipe_image);
        }
        foreach ($recipe->gallery as $img) {
            Storage::disk('public')->delete($img->image_name);
        }
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }
        // GET /recipes/{recipe}/edit -> raw PHP এর recipes-edit.php (ফর্ম)
    public function edit(Recipe $recipe)
    {
        $categories = Category::orderBy('cid', 'desc')->get();
        $recipe->load('gallery');

        return view('recipes.edit', compact('recipe', 'categories'));
    }

    // PUT /recipes/{recipe} -> raw PHP এর recipes-edit.php (update লজিক)
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'cat_id'              => 'required|exists:categories,cid',
            'recipe_title'        => 'required|string|max:255',
            'recipe_time'         => 'required|string|max:100',
            'recipe_description'  => 'required|string',
            'upload_type'         => 'required|in:Post,youtube,Url,Upload',

            'post_image'          => 'nullable|image|max:8192',
            'imageoption.*'       => 'nullable|image|max:8192',
            'youtube'             => 'nullable|required_if:upload_type,youtube|string',
            'image'               => 'nullable|image|max:8192',
            'url_source'          => 'nullable|required_if:upload_type,Url|string',
            'recipe_image'        => 'nullable|image|max:8192',
            'video'               => 'nullable|file|mimes:mp4,mov,wmv,mkv,3gp,m4v,flv|max:512000',
        ]);

        $data = [
            'cat_id'              => $request->cat_id,
            'recipe_title'        => $request->recipe_title,
            'recipe_time'         => $request->recipe_time,
            'recipe_description'  => $request->recipe_description,
            'content_type'        => $request->upload_type,
        ];

        switch ($request->upload_type) {

            case 'Upload':
                if ($request->hasFile('recipe_image')) {
                    $this->deleteOldImage($recipe->recipe_image);
                    $data['recipe_image'] = $request->file('recipe_image')->store('recipes', 'public');
                }
                if ($request->hasFile('video')) {
                    $this->deleteOldImage($recipe->video_url);
                    $data['video_url'] = $request->file('video')->store('recipes/videos', 'public');
                    $data['size']      = $this->formatBytes($request->file('video')->getSize());
                }
                break;

            case 'Url':
                $data['video_url'] = $request->url_source;
                if ($request->hasFile('image')) {
                    $this->deleteOldImage($recipe->recipe_image);
                    $data['recipe_image'] = $request->file('image')->store('recipes', 'public');
                }
                break;

            case 'Post':
                if ($request->hasFile('post_image')) {
                    $this->deleteOldImage($recipe->recipe_image);
                    $data['recipe_image'] = $request->file('post_image')->store('recipes', 'public');
                }
                if ($request->hasFile('imageoption')) {
                    foreach ($request->file('imageoption') as $file) {
                        RecipeGallery::create([
                            'recipe_id'  => $recipe->recipe_id,
                            'image_name' => $file->store('recipes/gallery', 'public'),
                        ]);
                    }
                }
                break;

            case 'youtube':
                $data['video_url'] = $request->youtube;
                $data['video_id']  = $this->extractYoutubeId($request->youtube) ?: 'cda11up';
                break;
        }

        $recipe->update($data);

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully!');
    }

    private function deleteOldImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

}
