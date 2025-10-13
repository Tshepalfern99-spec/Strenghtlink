<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Make 'status' a flexible string with a default of 'pending'
        // Works whether it was ENUM or VARCHAR before.
        DB::statement("ALTER TABLE reports MODIFY COLUMN status VARCHAR(32) NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Revert to an ENUM if you ever need to roll back.
        DB::statement("ALTER TABLE reports MODIFY COLUMN status ENUM('pending','in_review','resolved') NOT NULL DEFAULT 'pending'");
    }
};
