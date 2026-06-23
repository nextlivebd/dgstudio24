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
        Schema::create('home_trusted_section', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();         // "About Global Graphic Giant"
            $table->string('title')->nullable();            // "Trusted by 5,000+"
            $table->string('title_highlight')->nullable();   // "Happy Clients"
            $table->text('description')->nullable();        // paragraph description
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_trusted_section');
    }
};
