<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan_layanan', function (Blueprint $table) {
            $table->char('ID_PESANAN', 6);
            $table->char('ID_LAYANAN', 8);
            $table->char('JUMLAH_ITEM', 3)->nullable();
            $table->char('BERAT', 2)->nullable();
            $table->char('SUB_TOTAL', 12)->nullable();

            $table->foreign('ID_LAYANAN')->references('ID_LAYANAN')->on('layanan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('ID_PESANAN')->references('ID_PESANAN')->on('pesanan')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan_layanan');
    }
};
