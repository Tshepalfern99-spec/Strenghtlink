<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_category_id')->constrained()->cascadeOnDelete();
            $table->string('name', 160);
            $table->string('phone', 40)->nullable();
            $table->string('email', 160)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('province', 120)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['city','province']);
            $table->index(['name']);
        });
    }
    public function down(): void { Schema::dropIfExists('resources'); }
};