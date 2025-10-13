<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('contact_email', 255)->nullable()->after('is_anonymous');
        });
    }
    public function down(): void {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('contact_email');
        });
    }
};
