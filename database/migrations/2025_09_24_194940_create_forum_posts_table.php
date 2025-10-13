<?php

// database/migrations/2025_09_24_000001_create_forum_posts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 160);
            $table->text('body'); // markdown or plain text
            $table->string('media_image_path')->nullable(); // storage path
            $table->string('media_video_url')->nullable();  // e.g., youtu.be / youtube.com / vimeo
            $table->enum('visibility', ['public'])->default('public'); // future-proof
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('forum_posts');
    }
};
