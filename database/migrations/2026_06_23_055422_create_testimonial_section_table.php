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
        Schema::create('testimonial_section', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();             // "About us"
            $table->string('title')->nullable();                // "We deal with the aspects..."
            $table->string('title_highlight')->nullable();      // "Web Services" (span)
            $table->string('cta_text')->nullable();             // "Need a service & ready to order? Call us"
            $table->string('cta_phone')->nullable();            // "+1 (416) 686-3111"
            $table->string('right_image')->nullable();          // indicate2.jpg
            $table->integer('experience_count')->default(19);   // 19
            $table->string('experience_label')->nullable();     // "Years of Experience Web Solution"
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial_section');
    }
};
