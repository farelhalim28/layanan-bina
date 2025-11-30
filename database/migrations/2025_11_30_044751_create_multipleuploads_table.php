<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('multipleuploads', function (Blueprint $table) {
            $table->id();
            $table->string('filename'); // nama file yang tersimpan
            $table->string('original_name'); // nama file asli
            $table->string('file_path'); // path lengkap file
            $table->string('ref_table'); // table referensi
            $table->unsignedBigInteger('ref_id'); // ID referensi
            $table->timestamps();

            // Index untuk query cepat
            $table->index(['ref_table', 'ref_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('multipleuploads');
    }
};
