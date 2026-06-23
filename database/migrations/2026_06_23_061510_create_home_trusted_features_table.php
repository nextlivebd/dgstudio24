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
        Schema::create('home_trusted_features', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();             // e.g. "flaticon flaticon-24h"
            $table->string('title');                        // e.g. "100% Satisfaction"
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
        Schema::dropIfExists('home_trusted_features');
    }
};
