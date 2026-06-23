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
        Schema::create('home_video_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500)->nullable();
            $table->string('title_highlight')->nullable();
            $table->text('description')->nullable();
            $table->string('btn_text')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('background_image')->nullable();
            $table->string('logo_source')->default('site_logo'); // site_logo, custom_logo, none
            $table->string('custom_logo')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_video_banners');
    }
};
