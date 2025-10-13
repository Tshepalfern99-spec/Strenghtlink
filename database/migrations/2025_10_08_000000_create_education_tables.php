<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('education_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['awareness','rights','services'])->index();
            $table->string('summary', 500)->nullable();
            $table->longText('body')->nullable(); // rich text / markdown
            // media
            $table->enum('media_type', ['none','video','image','infographic','link'])->default('none');
            $table->string('media_url')->nullable();              // embeds (YouTube/Vimeo) or external links
            $table->string('cover_image_path')->nullable();       // storage path for card image
            $table->string('downloadable_path')->nullable();      // PDFs/etc in public disk
            $table->longText('video_transcript')->nullable();     // accessibility
            // publishing
            $table->boolean('is_published')->default(false)->index();
            $table->timestamp('published_at')->nullable()->index();
            // audit (admins table)
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('education_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_item_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->json('questions'); 
            // questions = [{ "q":"...", "choices":["a","b","c"], "answer":0, "explain":"..." }, ...]
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('education_quizzes');
        Schema::dropIfExists('education_items');
    }
};
