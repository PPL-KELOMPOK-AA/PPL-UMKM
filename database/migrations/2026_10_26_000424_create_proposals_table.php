<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id('id_proposal'); //atribut id_proposal : int
            $table->foreignId('id_UMKM')->constrained('umkms', 'id_UMKM')->onDelete('cascade'); //relasi ke UMKM
            $table->string('judul'); //judul : string
            $table->text('deskripsi_inovasi'); //deskripsi_inovasi : string
            $table->decimal('dana_dibutuhkan', 15, 2); //dana_dibutuhkan : decimal
            $table->date('tanggal_pengajuan'); //tanggal_pengajuan : date
            $table->string('file_proposal'); //menyimpan path file dokumen
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};