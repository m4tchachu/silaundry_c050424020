<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->char('ID_LAYANAN', 8)->primary();
            $table->string('NAMA_LAYANAN', 20)->nullable();
            $table->char('HARGA', 12)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanan');
    }
};
