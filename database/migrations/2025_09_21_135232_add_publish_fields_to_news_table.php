<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Only add columns if they don't exist
            if (! Schema::hasColumn('news', 'status')) {
                $table->enum('status', ['draft','published'])->default('draft')->after('body');
            }
            if (! Schema::hasColumn('news', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('status');
            }
            if (! Schema::hasColumn('news', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            if (! Schema::hasColumn('news', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('slug');
            }
            if (! Schema::hasColumn('news', 'cover_image_path')) {
                $table->string('cover_image_path')->nullable()->after('excerpt');
            }
            if (! Schema::hasColumn('news', 'author_id')) {
                $table->unsignedBigInteger('author_id')->nullable()->after('cover_image_path');
                // If you have an admins table/model:
                $table->foreign('author_id')->references('id')->on('admins')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news','author_id')) {
                $table->dropForeign(['author_id']);
                $table->dropColumn('author_id');
            }
            foreach (['cover_image_path','excerpt','slug','published_at','status'] as $col) {
                if (Schema::hasColumn('news', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
