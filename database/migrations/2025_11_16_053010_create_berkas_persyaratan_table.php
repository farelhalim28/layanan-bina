<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berkas_persyaratan', function (Blueprint $table) {
            $table->id('berkas_id');
            $table->unsignedBigInteger('permohonan_id');
            $table->string('nama_berkas');
            $table->boolean('valid')->default(false);
            $table->timestamps();

            $table->foreign('permohonan_id')->references('permohonan_id')->on('permohonan_surat')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berkas_persyaratan');
    }
};
