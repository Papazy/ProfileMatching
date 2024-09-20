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
        Schema::create('subcategory_relations', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->foreignId('subcategory1_id')->constrained('kategoris')->onDelete('cascade');  // Relasi ke subkategori 1
            $table->foreignId('subcategory2_id')->constrained('kategoris')->onDelete('cascade');  // Relasi ke subkategori 2
            $table->integer('score');  // Skor relasi antar subkategori
            $table->timestamps();  // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory_relations');
    }
};
