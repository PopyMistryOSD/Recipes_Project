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
        Schema::create('ads_placements', function (Blueprint $table) {
            $table->id();
            $table->boolean('home_screen')->default(1);
            $table->boolean('category_screen')->default(1);
            $table->boolean('detail_screen')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_placements');
    }
};
