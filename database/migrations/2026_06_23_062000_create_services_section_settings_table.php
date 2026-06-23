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
        Schema::create('services_section_settings', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();             // "Our Services"
            $table->string('title')->nullable();                // "We run all kinds of Web Development, Image Design & 3D services with 19+ years of"
            $table->string('title_highlight')->nullable();      // "experience"
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_section_settings');
    }
};
