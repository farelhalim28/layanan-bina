<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table'); // jenis_surat, permohonan_surat, berkas_persyaratan
            $table->unsignedBigInteger('ref_id'); // ID dari table yang di-refer
            $table->string('file_name'); // nama file yang disimpan
            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable(); // image/jpeg, application/pdf, dll
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Index untuk query cepat
            $table->index(['ref_table', 'ref_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
