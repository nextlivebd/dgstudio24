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
        Schema::create('home_trusted_counters', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();             // e.g. "flaticon flaticon-developer"
            $table->integer('count')->default(0);           // e.g. 14 / 90 / 13214 / 323510
            $table->string('label');                        // e.g. "Markets", "FTE", "Jobs Completed", "Deliverables"
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
        Schema::dropIfExists('home_trusted_counters');
    }
};
