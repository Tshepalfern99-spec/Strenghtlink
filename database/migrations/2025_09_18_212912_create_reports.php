<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // null if anonymous
            $table->boolean('is_anonymous')->default(false);
            $table->string('category', 80); // e.g., physical, emotional, economic, cyber
            $table->text('description');
            $table->string('location_text', 255)->nullable();
            $table->enum('status', ['new','in_review','resolved','archived'])->default('new');
            $table->timestamps();

            $table->index(['status','category']);
            $table->index(['is_anonymous']);
        });
    }
    public function down(): void { Schema::dropIfExists('reports'); }
};