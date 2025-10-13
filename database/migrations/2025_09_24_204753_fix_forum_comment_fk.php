<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('forum_comments', function (Blueprint $table) {
            if (!Schema::hasColumn('forum_comments', 'forum_post_id')) {
                $table->unsignedBigInteger('forum_post_id')->nullable()->after('id');
            }
        });

        // If old column exists, backfill values
        if (Schema::hasColumn('forum_comments', 'post_id')) {
            DB::table('forum_comments')->update([
                'forum_post_id' => DB::raw('post_id')
            ]);
        }

        Schema::table('forum_comments', function (Blueprint $table) {
            // add FK + index if not already present
            if (!Schema::hasColumn('forum_comments', 'forum_post_id')) return;

            // Avoid duplicate constraints in re-runs
            $table->index('forum_post_id', 'forum_comments_forum_post_id_index');

            // Add the constraint only if forums table exists
            if (Schema::hasTable('forum_posts')) {
                $table->foreign('forum_post_id')
                      ->references('id')->on('forum_posts')
                      ->onDelete('cascade');
            }
        });

        // Optional: drop old post_id column once everything works
        // Schema::table('forum_comments', function (Blueprint $table) {
        //     if (Schema::hasColumn('forum_comments', 'post_id')) {
        //         $table->dropColumn('post_id');
        //     }
        // });
    }

    public function down(): void
    {
        Schema::table('forum_comments', function (Blueprint $table) {
            if (Schema::hasColumn('forum_comments', 'forum_post_id')) {
                // drop FK + index safely if they exist (PDO-level constraints may need names)
                try { $table->dropForeign(['forum_post_id']); } catch (\Throwable $e) {}
                try { $table->dropIndex('forum_comments_forum_post_id_index'); } catch (\Throwable $e) {}
                $table->dropColumn('forum_post_id');
            }
        });
    }
};
