<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'ad_status', 'ad_type', 'backup_ads', 'interstitial_ad_interval',
    'native_ad_interval', 'native_ad_index', 'primary_ad_config', 'backup_ad_config'
])]
class Ad extends Model
{
    protected function casts(): array
    {
        return [
            'primary_ad_config' => 'array',
            'backup_ad_config' => 'array',
        ];
    }
}
