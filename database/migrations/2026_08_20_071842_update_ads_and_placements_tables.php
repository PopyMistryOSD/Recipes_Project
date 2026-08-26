<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->integer('native_ad_index')->default(0)->after('native_ad_interval');
        });

        Schema::table('ads_placements', function (Blueprint $table) {
            $table->dropColumn(['home_screen', 'category_screen', 'detail_screen']);

            $table->boolean('banner_home')->default(0);
            $table->boolean('banner_post_details')->default(0);
            $table->boolean('banner_category_details')->default(0);
            $table->boolean('banner_search')->default(0);
            $table->boolean('interstitial_post_list')->default(0);
            $table->boolean('interstitial_post_details')->default(0);
            $table->boolean('native_ad_home')->default(0);
            $table->boolean('native_ad_post_list')->default(0);
            $table->boolean('native_ad_post_details')->default(0);
            $table->boolean('native_ad_exit_dialog')->default(0);
            $table->boolean('app_open_ad_on_start')->default(0);
            $table->boolean('app_open_ad_on_resume')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('native_ad_index');
        });
        Schema::table('ads_placements', function (Blueprint $table) {
            $table->dropColumn([
                'banner_home', 'banner_post_details', 'banner_category_details', 'banner_search',
                'interstitial_post_list', 'interstitial_post_details', 'native_ad_home',
                'native_ad_post_list', 'native_ad_post_details', 'native_ad_exit_dialog',
                'app_open_ad_on_start', 'app_open_ad_on_resume',
            ]);
            $table->boolean('home_screen')->default(1);
            $table->boolean('category_screen')->default(1);
            $table->boolean('detail_screen')->default(1);
        });
    }
};
