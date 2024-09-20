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
        Schema::create('dashboard_kaprodis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade')->unique();
            $table->string('nim');
            $table->string('nama_mahasiswa');
            $table->date('tanggal_pengajuan');
            $table->text('judul_skripsi');
            $table->string('dosen_pembimbing_1');
            $table->string('dosen_pembimbing_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_kaprodis');
    }
};
