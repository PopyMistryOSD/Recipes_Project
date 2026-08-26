@extends('layouts.app')
@section('title', 'Manage Ads')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Manage Ads</h1>

    @php
        $fieldLabels = [
            'publisher_id' => 'Publisher ID',
            'app_id' => 'App ID',
            'banner_unit_id' => 'Banner Ad Unit ID',
            'interstitial_unit_id' => 'Interstitial Ad Unit ID',
            'native_unit_id' => 'Native Ad Unit ID',
            'app_open_ad_unit_id' => 'App Open Ad Unit ID',
            'game_id' => 'Game ID',
            'banner_placement_id' => 'Banner Placement ID',
            'interstitial_placement_id' => 'Interstitial Placement ID',
            'banner_ad_unit_id' => 'Banner Ad ID',
            'interstitial_ad_unit_id' => 'Interstitial Ad ID',
            'native_ad_manual_unit_id' => 'Native Ad (Manual) ID',
            'banner_zone_id' => 'Banner Zone ID',
            'banner_mrec_zone_id' => 'Banner (MREC) Zone ID',
            'interstitial_zone_id' => 'Interstitial Zone ID',
            'app_key' => 'App Key',
            'banner_placement_name' => 'Banner Placement Name',
            'interstitial_placement_name' => 'Interstitial Placement Name',
            'app_open_unit_id' => 'App Open Ad Unit ID',
        ];
        $networkLabels = [
            'admob' => 'AdMob',
            'google_ad_manager' => 'Google Ad Manager',
            'fan' => 'Meta Audience Network',
            'startapp' => 'StartApp',
            'unity' => 'Unity Ads',
            'applovin' => 'AppLovin MAX',
            'applovin_discovery' => 'AppLovin Discovery',
            'ironsource' => 'ironSource',
            'wortise' => 'Wortise',
        ];
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <form method="POST" action="{{ route('ads.update') }}" class="lg:col-span-2" x-data="{ primaryType: '{{ old('ad_type', $ad->ad_type ?? 'admob') }}', backupType: '{{ old('backup_ads', $ad->backup_ads ?? 'none') }}' }">
            @csrf

            <div class="bg-white p-6 rounded shadow space-y-6">

                <div>
                    <label class="block text-sm font-semibold mb-1">Ad Status</label>
                    <select name="ad_status" class="w-full border rounded px-3 py-2">
                        <option value="on" @selected(($ad->ad_status ?? 'off') === 'on')>ON</option>
                        <option value="off" @selected(($ad->ad_status ?? 'off') === 'off')>OFF</option>
                    </select>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-700 border-b pb-2 mb-3">PRIMARY ADS</h2>
                    <label class="block text-sm font-semibold mb-1">Primary Ad Network</label>
                    <select name="ad_type" x-model="primaryType" class="w-full border rounded px-3 py-2 mb-4">
                        @foreach ($networkLabels as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>

                    @foreach ($networkFields as $network => $fields)
                        <div x-show="primaryType === '{{ $network }}'" x-cloak class="space-y-3 mb-4">
                            @foreach ($fields as $field)
                                <div>
                                    <label
                                        class="block text-xs text-gray-600 mb-1">{{ $fieldLabels[$field] ?? $field }}</label>
                                    <input type="text" name="primary[{{ $network }}][{{ $field }}]"
                                        value="{{ old('primary.' . $network . '.' . $field, $ad->primary_ad_config[$network][$field] ?? '') }}"
                                        class="w-full border rounded px-3 py-2 text-sm">
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div>
                    <h2 class="font-semibold text-gray-700 border-b pb-2 mb-3">BACKUP ADS</h2>
                    <label class="block text-sm font-semibold mb-1">Backup Ads</label>
                    <select name="backup_ads" x-model="backupType" class="w-full border rounded px-3 py-2 mb-4">
                        <option value="none">None</option>
                        @foreach ($networkLabels as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>

                    @foreach ($networkFields as $network => $fields)
                        <div x-show="backupType === '{{ $network }}'" x-cloak class="space-y-3 mb-4">
                            @foreach ($fields as $field)
                                <div>
                                    <label
                                        class="block text-xs text-gray-600 mb-1">{{ $fieldLabels[$field] ?? $field }}</label>
                                    <input type="text" name="backup[{{ $network }}][{{ $field }}]"
                                        value="{{ old('backup.' . $network . '.' . $field, $ad->backup_ad_config[$network][$field] ?? '') }}"
                                        class="w-full border rounded px-3 py-2 text-sm">
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div>
                    <h2 class="font-semibold text-gray-700 border-b pb-2 mb-3">GLOBAL CONFIGURATION</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm mb-1">Interstitial Ad Interval</label>
                            <input type="number" name="interstitial_ad_interval"
                                value="{{ old('interstitial_ad_interval', $ad->interstitial_ad_interval) }}"
                                class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Native Ad Index</label>
                            <input type="number" name="native_ad_index"
                                value="{{ old('native_ad_index', $ad->native_ad_index) }}"
                                class="w-full border rounded px-3 py-2">
                        </div>
                    </div>
                    <input type="hidden" name="native_ad_interval" value="{{ $ad->native_ad_interval }}">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    UPDATE
                </button>
            </div>
        </form>

        @if (($ad->ad_status ?? 'off') === 'on')
            <div class="bg-white p-6 rounded shadow h-fit">
                <h2 class="font-semibold text-gray-700 border-b pb-2 mb-3">ADS PLACEMENT</h2>
                <p class="text-xs text-gray-500 mb-3">Enable or Disable Certain Ads Format Separately</p>

                @php
                    $placements = [
                        'banner_home' => 'Banner Ad on Home Page',
                        'banner_post_details' => 'Banner Ad on Recipe Details',
                        'banner_category_details' => 'Banner Ad on Category Details',
                        'banner_search' => 'Banner Ad on Search Page',
                        'interstitial_post_list' => 'Interstitial Ad on Recipe List',
                        'interstitial_post_details' => 'Interstitial on Recipe Details',
                        'native_ad_home' => 'Native Ad on Home',
                        'native_ad_post_list' => 'Native Ad on Recipe List',
                        'native_ad_post_details' => 'Native Ad on Recipe Details',
                        'native_ad_exit_dialog' => 'Native Ad on Exit Dialog',
                        'app_open_ad_on_start' => 'App Open Ad on Start',
                        'app_open_ad_on_resume' => 'App Open Ad on Resume',
                    ];
                @endphp

                <ul class="space-y-1 text-sm">
                    @foreach ($placements as $field => $label)
                        <li>
                            <a href="{{ route('ads.placement.toggle', $field) }}"
                                class="flex items-center gap-2 py-1.5 hover:bg-gray-50 rounded px-1">
                                <span
                                    class="material-icons text-lg {{ $placement->$field ? 'text-green-600' : 'text-gray-300' }}">
                                    {{ $placement->$field ? 'check_box' : 'check_box_outline_blank' }}
                                </span>
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
