<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // allow anonymous
            $table->unsignedBigInteger('report_id')->nullable(); // link to a report if feedback is about one
            $table->tinyInteger('rating')->nullable(); // 1..5 optional
            $table->text('message');
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('reports')->nullOnDelete();
            $table->index(['rating']);
        });
    }
    public function down(): void { Schema::dropIfExists('feedback'); }
};