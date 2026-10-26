
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('infografis_progres', function (Blueprint $table) {
            $table->id('id_infografis');
            $table->string('nama_proposal', 255);
            $table->string('deskripsi_progres', 255);
            $table->decimal('dana_terealisasi', 19, 0);
            $table->decimal('persen_progres', 19, 0);

            $table->unsignedBigInteger('id_UMKM');
            $table->unsignedBigInteger('id_investor');
            $table->unsignedBigInteger('id_regulasi');
            $table->unsignedBigInteger('id_kerja_sama');


            $table->foreign('id_UMKM')
                ->references('id_UMKM')
                ->on('umkms')
                ->cascadeOnDelete();

            $table->foreign('id_investor')
                ->references('id_investor')
                ->on('investors')
                ->cascadeOnDelete();

            $table->foreign('id_regulasi')
                ->references('id_regulasi')
                ->on('regulasis')
                ->cascadeOnDelete();

            $table->foreign('id_kerja_sama')
                ->references('id_kerja_sama')
                ->on('kerja_sama_pendanaans')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('infografis_progres');
    }
};
