<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('education_items', function (Blueprint $table) {
            // Slugs/Categorization/Type
            if (!Schema::hasColumn('education_items', 'slug'))        $table->string('slug')->nullable()->after('title');
            if (!Schema::hasColumn('education_items', 'category'))    $table->string('category', 100)->nullable()->after('slug');
            if (!Schema::hasColumn('education_items', 'type'))        $table->enum('type', ['article','video','infographic','download'])->default('article')->after('category');

            // Main content
            if (!Schema::hasColumn('education_items', 'body'))        $table->longText('body')->nullable()->change();

            // Media fields used by controller/views
            if (!Schema::hasColumn('education_items', 'video_url'))      $table->string('video_url', 500)->nullable()->after('body');
            if (!Schema::hasColumn('education_items', 'cover_path'))     $table->string('cover_path', 255)->nullable()->after('video_url');
            if (!Schema::hasColumn('education_items', 'download_path'))  $table->string('download_path', 255)->nullable()->after('cover_path');

            // Publishing/ownership
            if (!Schema::hasColumn('education_items', 'published_at'))   $table->timestamp('published_at')->nullable()->after('download_path');
            if (!Schema::hasColumn('education_items', 'author_admin_id'))$table->unsignedBigInteger('author_admin_id')->nullable()->after('published_at');

            // Optional: FK (no cascade here; keep nullable)
            // $table->foreign('author_admin_id')->references('id')->on('admins')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('education_items', function (Blueprint $table) {
            // Only drop what we added (guard with hasColumn to be safe)
            foreach (['slug','category','type','video_url','cover_path','download_path','published_at','author_admin_id'] as $col) {
                if (Schema::hasColumn('education_items', $col)) $table->dropColumn($col);
            }
        });
    }
};
