<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'banner_home', 'banner_post_details', 'banner_category_details', 'banner_search',
    'interstitial_post_list', 'interstitial_post_details', 'native_ad_home',
    'native_ad_post_list', 'native_ad_post_details', 'native_ad_exit_dialog',
    'app_open_ad_on_start', 'app_open_ad_on_resume',
])]
class AdsPlacement extends Model
{
}
