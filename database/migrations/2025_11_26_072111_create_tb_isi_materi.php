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
        Schema::create('tb_isi_materi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_materi')->constrained('tb_materi')->onDelete('cascade');
            $table->string('judul', 150);
            $table->longText('konten');

            // Tipe konten: text, video, atau file
            $table->enum('tipe', ['text', 'video', 'file'])->default('text');

            // Lokasi file/video (jika ada)
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_isi_materi');
    }
};
