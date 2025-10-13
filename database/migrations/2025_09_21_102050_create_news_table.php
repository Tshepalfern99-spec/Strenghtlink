<?php

// database/migrations/2025_09_21_000000_create_news_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt', 500)->nullable();
            $table->longText('body')->nullable();
            $table->string('cover_image')->nullable(); // storage path or URL
            $table->foreignId('author_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('news', function (Blueprint $table) {
            $table->index(['published_at']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('news');
    }
};
