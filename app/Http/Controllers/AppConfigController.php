<?php

namespace App\Http\Controllers;

use App\Models\AppConfig;
use App\Models\Setting;
use Illuminate\Http\Request;

class AppConfigController extends Controller
{
    // GET /apps -> raw PHP এর apps.php
    public function index(Request $request)
    {
        $query = AppConfig::query();

        if ($request->filled('keyword')) {
            $query->where('package_name', 'like', '%' . $request->keyword . '%');
        }

        $apps = $query->orderBy('id', 'desc')->paginate(15);
        $apiKey = optional(Setting::find(1))->api_key;

        return view('apps.index', compact('apps', 'apiKey'));
    }

    // GET /apps/create -> raw PHP এর apps-add.php (ফর্ম)
    public function create()
    {
        return view('apps.create');
    }

    // POST /apps -> raw PHP এর apps-add.php (submit লজিক)
    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'status'       => 'required|in:active,inactive',
            'redirect_url' => 'nullable|string',
        ]);

        $exists = AppConfig::where('package_name', $request->package_name)->exists();

        if ($exists) {
            return back()->with('error', 'Package name already added...');
        }

        AppConfig::create([
            'package_name' => $request->package_name,
            'status'       => $request->status === 'active' ? 1 : 0,
            'redirect_url' => $request->redirect_url,
        ]);

        return redirect()->route('apps.index')->with('success', 'App added successfully...');
    }

    // GET /apps/{app}/edit -> raw PHP এর apps-edit.php (ফর্ম)
    public function edit(AppConfig $app)
    {
        return view('apps.edit', compact('app'));
    }

    //PUT /apps/{app} -> raw PHP এর apps-edit.php (update লজিক)
    public function update(Request $request, AppConfig $app)
    {
        $request->validate([
            'status'       => 'required|in:active,inactive',
            'redirect_url' => 'nullable|string',
        ]);

        $app->update([
            'status'       => $request->status === 'active' ? 1 : 0,
            'redirect_url' => $request->redirect_url,
        ]);

        return redirect()->route('apps.edit', $app->id)->with('success', 'Changes Saved...');
    }


    // public function update(Request $request, AppConfig $app)
    // {
    //     $request->validate([
    //         'package_name' => 'required|string|max:255',
    //         'status'       => 'required|in:active,inactive',
    //         'redirect_url' => 'nullable|string',
    //     ]);

    //     $duplicate = AppConfig::where('package_name', $request->package_name)
    //         ->where('id', '!=', $app->id)
    //         ->exists();

    //     if ($duplicate) {
    //         return back()->with('error', 'Package name already added...')->withInput();
    //     }

    //     $app->update([
    //         'package_name' => $request->package_name,
    //         'status'       => $request->status === 'active' ? 1 : 0,
    //         'redirect_url' => $request->redirect_url,
    //     ]);

    //     return redirect()->route('apps.edit', $app->id)->with('success', 'Changes Saved...');
    // }


    // GET /apps/{app}/delete -> raw PHP এর ?delete= লজিক
    public function destroy(AppConfig $app)
    {
        $app->delete();

        return redirect()->route('apps.index')->with('success', 'App deleted successfully...');
    }

    // Server Key generate করার helper (raw PHP এর base64 triple-encode লজিক)
    public static function generateServerKey(string $packageName): string
    {
        $serverUrl = request()->getSchemeAndHttpHost();
        $plainText = $serverUrl . '_applicationId_' . $packageName;

        return base64_encode(base64_encode(base64_encode($plainText)));
    }
}
