
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kerja_sama_pendanaans', function (Blueprint $table) {
            $table->id('id_kerja_sama');
            $table->decimal('dana_disepakati', 19, 0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->unsignedBigInteger('id_investor');
            $table->unsignedBigInteger('id_UMKM');

            $table->foreign('id_investor')
                ->references('id_investor')
                ->on('investors')
                ->cascadeOnDelete();

            $table->foreign('id_UMKM')
                ->references('id_UMKM')
                ->on('umkms')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerja_sama_pendanaans');
    }
};
