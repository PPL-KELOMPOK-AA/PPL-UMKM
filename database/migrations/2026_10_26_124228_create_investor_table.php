
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id('id_investor');
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('nama_investor', 255);
            $table->decimal('dana_tersedia', 19, 0);
            $table->string('jenis_investor', 255);
            $table->string('status_verifikasi', 255);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
