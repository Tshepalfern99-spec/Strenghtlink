<?php 
// database/migrations/2025_10_07_000001_add_parent_id_to_forum_comments.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('forum_comments', 'parent_id')) {
            Schema::table('forum_comments', function (Blueprint $table) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('post_id');
                $table->foreign('parent_id')->references('id')->on('forum_comments')->onDelete('cascade');
                $table->index('parent_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('forum_comments', 'parent_id')) {
            Schema::table('forum_comments', function (Blueprint $table) {
                $table->dropForeign(['parent_id']);
                $table->dropIndex(['parent_id']);
                $table->dropColumn('parent_id');
            });
        }
    }
};
