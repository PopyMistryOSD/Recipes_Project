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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id('recipe_id');
            $table->foreignId('cat_id')->constrained('categories', 'cid')->onDelete('cascade');
            $table->string('recipe_title');
            $table->string('video_url')->nullable();
            $table->string('video_id')->nullable();
            $table->string('recipe_image')->nullable();
            $table->string('recipe_time')->nullable();
            $table->longText('recipe_description')->nullable();
            $table->enum('content_type', ['Post', 'youtube', 'Url', 'Upload'])->default('Post');
            $table->string('size')->nullable();
            $table->boolean('featured')->default(0);
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('total_views')->default(0);
            $table->timestamp('last_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
