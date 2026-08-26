<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdsPlacement;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public const NETWORK_FIELDS = [
        'admob' => ['publisher_id', 'app_id', 'banner_unit_id', 'interstitial_unit_id', 'native_unit_id', 'app_open_ad_unit_id'],
        'google_ad_manager' => ['banner_unit_id', 'interstitial_unit_id', 'native_unit_id', 'app_open_ad_unit_id'],
        'fan' => ['banner_unit_id', 'interstitial_unit_id', 'native_unit_id'],
        'startapp' => ['app_id'],
        'unity' => ['game_id', 'banner_placement_id', 'interstitial_placement_id'],
        'applovin' => ['banner_ad_unit_id', 'interstitial_ad_unit_id', 'native_ad_manual_unit_id', 'app_open_ad_unit_id'],
        'applovin_discovery' => ['banner_zone_id', 'banner_mrec_zone_id', 'interstitial_zone_id'],
        'ironsource' => ['app_key', 'banner_placement_name', 'interstitial_placement_name'],
        'wortise' => ['app_id', 'banner_unit_id', 'interstitial_unit_id', 'native_unit_id', 'app_open_unit_id'],
    ];

    public function index()
    {
        $ad = Ad::firstOrCreate(['id' => 1], ['ad_status' => 'off']);
        $placement = AdsPlacement::firstOrCreate(['id' => 1]);

        return view('ads.index', [
            'ad' => $ad,
            'placement' => $placement,
            'networkFields' => self::NETWORK_FIELDS,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'ad_status' => 'required|in:on,off',
            'ad_type'   => 'required|string',
            'backup_ads' => 'required|string',
            'interstitial_ad_interval' => 'nullable|integer',
            'native_ad_index' => 'nullable|integer',
        ]);

        if ($request->backup_ads !== 'none' && $request->backup_ads === $request->ad_type) {
            return back()->with('error', 'Backup Ad cannot be the same as Primary Ad and vice versa!');
        }

        $ad = Ad::firstOrCreate(['id' => 1]);

        $primaryConfig = $ad->primary_ad_config ?? [];
        $backupConfig  = $ad->backup_ad_config ?? [];

        if ($request->has('primary') && isset(self::NETWORK_FIELDS[$request->ad_type])) {
            $primaryConfig[$request->ad_type] = $request->input('primary.' . $request->ad_type, []);
        }

        if ($request->backup_ads !== 'none' && $request->has('backup') && isset(self::NETWORK_FIELDS[$request->backup_ads])) {
            $backupConfig[$request->backup_ads] = $request->input('backup.' . $request->backup_ads, []);
        }

        $ad->update([
            'ad_status' => $request->ad_status,
            'ad_type' => $request->ad_type,
            'backup_ads' => $request->backup_ads,
            'interstitial_ad_interval' => $request->interstitial_ad_interval,
            'native_ad_interval' => $request->native_ad_interval,
            'native_ad_index' => $request->native_ad_index,
            'primary_ad_config' => $primaryConfig,
            'backup_ad_config' => $backupConfig,
        ]);

        return redirect()->route('ads.index')->with('success', 'Changes Saved...');
    }

    public function togglePlacement(Request $request, string $field)
    {
        $allowed = [
            'banner_home', 'banner_post_details', 'banner_category_details', 'banner_search',
            'interstitial_post_list', 'interstitial_post_details', 'native_ad_home',
            'native_ad_post_list', 'native_ad_post_details', 'native_ad_exit_dialog',
            'app_open_ad_on_start', 'app_open_ad_on_resume',
        ];

        if (! in_array($field, $allowed)) {
            abort(404);
        }

        $placement = AdsPlacement::firstOrCreate(['id' => 1]);
        $placement->update([$field => ! $placement->$field]);

        return redirect()->route('ads.index');
    }
}
