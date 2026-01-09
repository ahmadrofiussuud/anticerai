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
        Schema::create('couples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('husband_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('wife_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('pairing_code', 6)->unique();
            $table->date('anniversary_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couples');
    }
};
