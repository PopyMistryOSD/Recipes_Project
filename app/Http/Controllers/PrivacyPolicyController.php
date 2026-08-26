<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class PrivacyPolicyController extends Controller
{
    public function show()
    {
        $setting = Setting::latest('id')->first();

        return view('privacy', [
            'privacyPolicy' => $setting->privacy_policy ?? '',
        ]);
    }
}
