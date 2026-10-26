
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regulasis', function (Blueprint $table) {
            $table->id('id_regulasi');
            $table->string('judul', 255);
            $table->string('jenis_regulasi', 255);
            $table->string('deskripsi', 255);
            $table->date('tanggal_berlaku');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regulasis');
    }
};
