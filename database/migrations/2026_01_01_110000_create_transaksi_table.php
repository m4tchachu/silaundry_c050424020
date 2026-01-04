<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->char('ID_TRANSAKSI', 8)->primary();
            $table->char('ID_PESANAN', 6);
            $table->char('TOTAL_BIAYA', 12)->nullable();
            $table->string('STATUS', 20);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ID_PESANAN')->references('ID_PESANAN')->on('pesanan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
