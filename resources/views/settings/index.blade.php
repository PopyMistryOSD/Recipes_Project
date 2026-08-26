@extends('layouts.app')
@section('title', 'Settings')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Settings</h1>
    </div>

    <form method="POST" action="{{ route('settings.update') }}" class="bg-white p-6 rounded shadow max-w-3xl space-y-6">
        @csrf

        <div>
            <h2 class="font-semibold text-gray-700 mb-3 border-b pb-2 text-base">KEYS &amp; IDS</h2>

            <div class="bg-blue-50 border border-blue-200 text-blue-800 text-sm p-3 rounded mb-4">
                applicationId (Package Name) and Server Key configuration moved to Apps menu.
                <a href="{{ \Illuminate\Support\Facades\Route::has('apps.index') ? route('apps.index') : '#' }}"
                    class="inline-block mt-2 bg-white border border-blue-300 text-blue-700 px-3 py-1 rounded text-xs hover:bg-blue-100">
                    OPEN APPS MENU
                </a>
            </div>

            <input type="hidden" name="package_name" value="{{ $setting->package_name }}">
            <input type="hidden" name="youtube_api_key" value="{{ $setting->youtube_api_key }}">

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Rest API Key</label>
                <input type="text" value="{{ $setting->api_key }}" readonly
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500">
                <p class="text-xs text-blue-600 mt-1">
                    <a
                        href="{{ \Illuminate\Support\Facades\Route::has('settings.api-key') ? route('settings.api-key') : '#' }}">CHANGE
                        API KEY</a>
                </p>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">More Apps Url</label>
                <input type="text" name="more_apps_url" value="{{ old('more_apps_url', $setting->more_apps_url) }}"
                    class="w-full border rounded px-3 py-2" required>
                <p class="text-xs text-blue-600 mt-1">More apps url for other apps</p>
            </div>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700 mb-3 border-b pb-2 text-base">PUSH NOTIFICATION</h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Provider</label>
                <select name="providers" class="w-full border rounded px-3 py-2">
                    <option value="firebase" @selected(old('providers', $setting->providers) !== 'onesignal')>
                        Firebase Cloud Messaging (FCM)
                    </option>
                    <option value="onesignal" @selected(old('providers', $setting->providers) === 'onesignal')>
                        OneSignal
                    </option>
                </select>
                <p class="text-xs text-blue-600 mt-1">Choose your provider for sending push notification</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">FCM Server Key</label>
                <input type="text" name="app_fcm_key" value="{{ old('app_fcm_key', $setting->app_fcm_key) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">FCM Notification Topic</label>
                <input type="text" name="fcm_notification_topic"
                    value="{{ old('fcm_notification_topic', $setting->fcm_notification_topic) }}"
                    class="w-full border rounded px-3 py-2" required>
                <p class="text-xs text-blue-600 mt-1">FCM notification topic must be written in lowercase without space (use
                    underscore)</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">OneSignal APP ID</label>
                <input type="text" name="onesignal_app_id"
                    value="{{ old('onesignal_app_id', $setting->onesignal_app_id) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">OneSignal Rest API Key</label>
                <input type="text" name="onesignal_rest_api_key"
                    value="{{ old('onesignal_rest_api_key', $setting->onesignal_rest_api_key) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700 mb-3 border-b pb-2 text-base">PRIVACY</h2>
            <label class="block text-sm font-semibold mb-1">Privacy Policy</label>
            <textarea name="privacy_policy" rows="10" class="w-full border rounded px-3 py-2" required>{{ old('privacy_policy', $setting->privacy_policy) }}</textarea>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                UPDATE
            </button>
        </div>
    </form>
@endsection
