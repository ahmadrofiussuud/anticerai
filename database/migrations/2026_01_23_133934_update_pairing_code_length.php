<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_pairing_code_unique');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->string('pairing_code', 10)->nullable()->change();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->unique('pairing_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_pairing_code_unique');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->string('pairing_code', 6)->nullable()->change();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->unique('pairing_code');
        });
    }
};
