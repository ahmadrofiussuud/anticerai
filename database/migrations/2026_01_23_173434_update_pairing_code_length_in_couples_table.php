<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('couples', function (Blueprint $table) {
            // Match the 10-character length you set in the users table
            $table->string('pairing_code', 10)->change();
        });
    }

    public function down(): void
    {
        Schema::table('couples', function (Blueprint $table) {
            $table->string('pairing_code', 6)->change();
        });
    }
};
