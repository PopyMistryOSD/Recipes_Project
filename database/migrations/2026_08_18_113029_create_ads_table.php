<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->boolean('ad_status')->default(1);
            $table->string('ad_type')->nullable();
            $table->string('backup_ads')->nullable();
            $table->integer('interstitial_ad_interval')->nullable();
            $table->integer('native_ad_interval')->nullable();
            $table->json('primary_ad_config')->nullable();
            $table->json('backup_ad_config')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
