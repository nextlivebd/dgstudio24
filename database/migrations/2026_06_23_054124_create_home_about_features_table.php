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
        Schema::create('home_about_features', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();             // e.g. "ti ti-medall"
            $table->string('title')->nullable();            // "100% Satisfaction"
            $table->text('description')->nullable();        // feature description
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_about_features');
    }
};
