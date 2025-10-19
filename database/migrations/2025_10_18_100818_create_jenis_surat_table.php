<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->id('jenis_id'); // PK
            $table->string('kode', 20)->unique(); // UNQ
            $table->string('nama_jenis', 100);
            $table->text('syarat_json')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_surat');
    }
};
