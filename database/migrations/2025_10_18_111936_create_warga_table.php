<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id('warga_id'); // PK
            $table->string('no_ktp', 20)->unique(); // UNQ
            $table->string('nama', 100);
            $table->string('jenis_kelamin', 10);
            $table->string('agama', 50);
            $table->string('pekerjaan', 100);
            $table->string('telp', 20);
            $table->string('email', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga');
    }
};
