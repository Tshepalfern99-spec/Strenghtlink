<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('display_name', 120)->nullable(); // alias if desired
            $table->boolean('is_private')->default(true);    // privacy toggle
            $table->string('city', 120)->nullable();
            $table->string('province', 120)->nullable();
            $table->string('phone', 40)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('user_profiles'); }
};
