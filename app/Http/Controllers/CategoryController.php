<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // GET /categories -> raw PHP এর category.php
    public function index(Request $request)
    {
        $query = Category::query();

        // raw PHP এর "keyword" search এর সমতুল্য
        if ($request->filled('search')) {
            $query->where('category_name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->orderBy('cid', 'desc')->paginate(15);

        return view('categories.index', compact('categories'));
    }

    // GET /categories/create -> raw PHP এর category-add.php (ফর্ম)
    public function create()
    {
        return view('categories.create');
    }

    // POST /categories -> raw PHP এর category-add.php (save লজিক)
    public function store(Request $request)
    {
        $request->validate([
            'category_name'  => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'category_name' => $request->category_name,
            'featured'      => $request->boolean('featured'),
        ];

        if ($request->hasFile('category_image')) {
            $data['category_image'] = $request->file('category_image')
                ->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category added successfully!');
    }

    // GET /categories/{category}/edit -> raw PHP এর category-edit.php (ফর্ম)
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // PUT /categories/{category} -> raw PHP এর category-edit.php (update লজিক)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name'  => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'category_name' => $request->category_name,
            'featured'      => $request->boolean('featured'),
        ];

        if ($request->hasFile('category_image')) {
            // পুরনো image ডিলিট করে দিচ্ছি, storage জমে থাকা আবর্জনা এড়াতে
            if ($category->category_image) {
                Storage::disk('public')->delete($category->category_image);
            }
            $data['category_image'] = $request->file('category_image')
                ->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    // DELETE /categories/{category} -> raw PHP এর category-delete.php
    public function destroy(Category $category)
    {
        if ($category->category_image) {
            Storage::disk('public')->delete($category->category_image);
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
