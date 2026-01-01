<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan_satuan', function (Blueprint $table) {
            $table->char('ID_PESANAN', 6);
            $table->char('ID_SATUAN', 4);
            $table->char('JUMLAH_ITEM', 3)->nullable();
            $table->char('SUB_TOTAL', 12)->nullable();

            $table->foreign('ID_SATUAN')->references('ID_SATUAN')->on('jenis_satuan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('ID_PESANAN')->references('ID_PESANAN')->on('pesanan')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan_satuan');
    }
};
