<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'app_fcm_key', 'api_key', 'package_name', 'onesignal_app_id',
    'onesignal_rest_api_key', 'providers', 'fcm_notification_topic',
    'privacy_policy', 'youtube_api_key', 'more_apps_url'
])]
class Setting extends Model
{
}
