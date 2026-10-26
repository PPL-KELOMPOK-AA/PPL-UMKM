
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penawaran_pendanaans', function (Blueprint $table) {
            $table->id('id_penawaran');
            $table->decimal('jumlah_dana', 19, 0);
            $table->string('persyaratan', 255);
            $table->date('tanggal_penawaran');

            $table->unsignedBigInteger('id_proposal');
            $table->unsignedBigInteger('id_investor');

            // Foreign key dengan penamaan yang lebih standar
            $table->foreign('id_proposal')
                ->references('id_proposal')
                ->on('proposals')
                ->cascadeOnDelete();

            $table->foreign('id_investor')
                ->references('id_investor')
                ->on('investors')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penawaran_pendanaans');
    }
};
