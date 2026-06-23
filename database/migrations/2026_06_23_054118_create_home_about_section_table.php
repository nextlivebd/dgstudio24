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
        Schema::create('home_about_section', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();         // "About Global Graphic Giant"
            $table->string('title')->nullable();            // main heading (h3)
            $table->text('description')->nullable();        // paragraph text
            $table->string('image')->nullable();            // left-side image
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_about_section');
    }
};
