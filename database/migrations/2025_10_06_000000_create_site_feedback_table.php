<?php 
// database/migrations/2025_10_06_000000_create_site_feedback_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('site_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // nullable for anonymous
            $table->tinyInteger('rating')->nullable(); // 1-5
            $table->string('category', 50)->nullable(); // 'ui','performance','content','bug','other'
            $table->string('page_url', 2048)->nullable();
            $table->string('device', 255)->nullable(); // UA summary
            $table->string('contact_email')->nullable();
            $table->boolean('consent_contact')->default(false);
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('site_feedback');
    }
};
