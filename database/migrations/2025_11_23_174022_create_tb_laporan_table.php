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
        Schema::create('tb_laporan', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_report');
            $table->string('keterangan_report');
            $table->enum('status_laporan', ['belum diproses', 'diproses', 'selesai', 'ditolak']);
            $table->foreignId('kelas_id')->constrained('tb_kelas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('tb_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_laporan');
    }
};
