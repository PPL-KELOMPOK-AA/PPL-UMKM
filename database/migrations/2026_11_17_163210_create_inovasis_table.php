<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inovasis', function (Blueprint $table) {
            $table->id('id_inovasi');

            $table->unsignedBigInteger('id_UMKM');

            $table->string('nama_inovasi');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->string('status');

            $table->foreign('id_UMKM')
                  ->references('id_UMKM')
                  ->on('umkms')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inovasis');
    }
};