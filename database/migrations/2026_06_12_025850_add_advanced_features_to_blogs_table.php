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
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('status')->default('draft')->after('thumbnail');
            $table->string('meta_title')->nullable()->after('status');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            $table->boolean('is_featured')->default(0)->after('meta_keywords');
            $table->unsignedBigInteger('views')->default(0)->after('is_featured');
            $table->timestamp('published_at')->nullable()->after('views');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['status', 'meta_title', 'meta_description', 'meta_keywords', 'is_featured', 'views', 'published_at']);
            $table->boolean('status')->default(1);
        });
    }
};
