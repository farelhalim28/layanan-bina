<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permohonan_surat', function (Blueprint $table) {
            $table->id('permohonan_id');
            $table->string('nomor_permohonan')->unique();
            $table->unsignedBigInteger('pemohon_warga_id');
            $table->unsignedBigInteger('jenis_id');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('pemohon_warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
            $table->foreign('jenis_id')->references('jenis_id')->on('jenis_surat')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_surat');
    }
};
