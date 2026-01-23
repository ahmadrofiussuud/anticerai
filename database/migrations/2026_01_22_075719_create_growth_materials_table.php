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
        Schema::create('growth_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // 'video' or 'article'
            $table->string('url')->nullable(); 
            $table->string('thumbnail_url');
            $table->text('description')->nullable(); // Content for articles
            $table->string('subtitle')->nullable();
            $table->string('duration')->nullable();
            $table->string('views')->default('0');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('growth_materials');
    }
};
