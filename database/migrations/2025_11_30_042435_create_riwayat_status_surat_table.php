
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_status_surat', function (Blueprint $table) {
            $table->id('riwayat_id');
            $table->unsignedBigInteger('permohonan_id');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak']);
            $table->unsignedBigInteger('petugas_warga_id');
            $table->dateTime('waktu');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('permohonan_id')->references('permohonan_id')->on('permohonan_surat')->onDelete('cascade');
            $table->foreign('petugas_warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_status_surat');
    }
};
