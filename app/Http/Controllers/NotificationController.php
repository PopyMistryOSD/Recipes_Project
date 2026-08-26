<?php

namespace App\Http\Controllers;

use App\Models\NotificationTemplate;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    // GET /notifications -> raw PHP এর notification.php
    public function index(Request $request)
    {
        $query = NotificationTemplate::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        $templates = $query->orderBy('id', 'desc')->paginate(15);

        return view('notifications.index', compact('templates'));
    }

    // GET /notifications/create -> raw PHP এর notification-add.php (ফর্ম)
    public function create()
    {
        return view('notifications.create');
    }

    // POST /notifications -> raw PHP এর notification-add.php (submit লজিক)
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'image'   => 'required|image|mimes:jpg,jpeg,png,gif|max:3072',
            'link'    => 'nullable|string',
        ]);

        NotificationTemplate::create([
            'title'   => $request->title,
            'message' => $request->message,
            'image'   => $request->file('image')->store('notifications', 'public'),
            'link'    => $request->link,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification added successfully...');
    }

    // GET /notifications/{notification}/edit -> raw PHP এর notification-edit.php (ফর্ম)
    public function edit(NotificationTemplate $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    // PUT /notifications/{notification} -> raw PHP এর notification-edit.php (update লজিক)
    public function update(Request $request, NotificationTemplate $notification)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:3072',
            'link'    => 'nullable|string',
        ]);

        $data = [
            'title'   => $request->title,
            'message' => $request->message,
            'link'    => $request->link,
        ];

        if ($request->hasFile('image')) {
            if ($notification->image) {
                Storage::disk('public')->delete($notification->image);
            }
            $data['image'] = $request->file('image')->store('notifications', 'public');
        }

        $notification->update($data);

        return redirect()->route('notifications.index')->with('success', 'Changes Saved...');
    }

    // GET /notifications/{notification}/delete -> raw PHP এর notification-delete.php
    public function destroy(NotificationTemplate $notification)
    {
        if ($notification->image) {
            Storage::disk('public')->delete($notification->image);
        }
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully...');
    }

    // GET /notifications/{notification}/send -> raw PHP এর notification-send.php (ফর্ম)
    public function showSend(NotificationTemplate $notification)
    {
        return view('notifications.send', compact('notification'));
    }

    // POST /notifications/{notification}/send -> raw PHP এর notification-send.php (submit লজিক)
    public function send(Request $request, NotificationTemplate $notification)
    {
        $request->validate([
            'title'   => 'required|string',
            'message' => 'required|string',
            'link'    => 'nullable|string',
        ]);

        $setting = Setting::find(1);

        if (! $setting) {
            return back()->with('error', 'Settings not configured yet!');
        }

        $bigImage = $notification->image ? Storage::url($notification->image) : null;
        $bigImage = $bigImage ? url($bigImage) : null;

        $success = match ($setting->providers) {
            'onesignal' => $this->sendViaOneSignal($request, $setting, $bigImage),
            default     => $this->sendViaFcm($request, $setting, $bigImage),
        };

        if ($success) {
            $providerName = $setting->providers === 'onesignal' ? 'OneSignal' : 'FCM';
            return redirect()->route('notifications.index')->with('success', "$providerName push notification sent...");
        }

        return back()->with('error', 'Failed to send notification. Please check your provider keys in Settings.');
    }

    private function sendViaFcm(Request $request, Setting $setting, ?string $bigImage): bool
    {
        $response = Http::withHeaders([
            'Authorization' => 'key=' . $setting->app_fcm_key,
            'Content-Type'  => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'to'   => '/topics/' . $setting->fcm_notification_topic,
            'data' => [
                'title'     => $request->title,
                'message'   => $request->message,
                'big_image' => $bigImage,
                'link'      => $request->link,
                'post_id'   => '0',
                'unique_id' => rand(1000, 9999),
            ],
        ]);

        return $response->successful();
    }

    private function sendViaOneSignal(Request $request, Setting $setting, ?string $bigImage): bool
    {
        $response = Http::withHeaders([
            'Content-Type'  => 'application/json; charset=utf-8',
            'Authorization' => 'Basic ' . $setting->onesignal_rest_api_key,
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id'             => $setting->onesignal_app_id,
            'included_segments'  => ['All'],
            'data'               => [
                'link'      => $request->link,
                'post_id'   => '0',
                'unique_id' => rand(1000, 9999),
            ],
            'headings'    => ['en' => $request->title],
            'contents'    => ['en' => $request->message],
            'big_picture' => $bigImage,
        ]);

        return $response->successful();
    }
}
