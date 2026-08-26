<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);

        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'more_apps_url'           => 'required|string',
            'providers'               => 'required|in:onesignal,firebase',
            'app_fcm_key'             => 'required|string',
            'fcm_notification_topic'  => 'required|string',
            'onesignal_app_id'        => 'required|string',
            'onesignal_rest_api_key'  => 'required|string',
            'privacy_policy'          => 'required|string',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);

        // api_key, package_name, youtube_api_key — এগুলো এই ফর্ম থেকে পরিবর্তন হয় না
        // (raw PHP তেও readonly/hidden ছিল, api_key পরিবর্তনের জন্য আলাদা api-key.php ছিল)
        $setting->update($request->only([
            'more_apps_url', 'providers', 'app_fcm_key',
            'fcm_notification_topic', 'onesignal_app_id',
            'onesignal_rest_api_key', 'privacy_policy',
        ]));

        return redirect()->route('settings.index')->with('success', 'Changes saved...');
    }

    public function changeApiKey()
    {
        return view('settings.api-key');
    }

    public function generateApiKey()
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $randomKey = substr(str_shuffle($characters), 0, 45);
        $generatedKey = 'cda11' . $randomKey;

        return view('settings.api-key', compact('generatedKey'));
    }

    public function updateApiKey(Request $request)
    {
        $request->validate([
            'api_key' => 'required|string',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);
        $setting->update(['api_key' => $request->api_key]);

        return redirect()->route('settings.index')->with('success', 'Changes saved...');
    }
}
