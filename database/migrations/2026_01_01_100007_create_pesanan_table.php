<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->char('ID_PESANAN', 6)->primary();
            $table->char('ID_PELANGGAN', 4);
            $table->char('ID_ADMIN', 5);
            $table->char('ID_KURIR', 4)->nullable();
            $table->char('ID_KILOAN', 6)->nullable();
            $table->date('TANGGAL_MASUK')->nullable();
            $table->date('ESTIMASI_SELESAI')->nullable();
            $table->char('JUMLAH_ITEM', 3)->nullable();
            $table->char('BERAT', 3)->nullable();
            $table->string('STATUS', 10)->nullable();
            $table->char('TOTAL_BIAYA', 12)->nullable();
            $table->string('CATATAN', 255)->nullable();

            $table->foreign('ID_PELANGGAN')->references('ID_PELANGGAN')->on('pelanggan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('ID_ADMIN')->references('ID_ADMIN')->on('admin')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('ID_KILOAN')->references('ID_KILOAN')->on('jenis_kiloan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('ID_KURIR')->references('ID_KURIR')->on('kurir')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};
