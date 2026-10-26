
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            // Harus cocok dengan foreignId pada migration proposals
            $table->id('id_UMKM');

            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('nama_usaha', 255);
            $table->string('NIB', 255);
            $table->string('bidang_usaha', 255);
            $table->string('alamat', 255);
            $table->string('status_verifikasi', 255);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
