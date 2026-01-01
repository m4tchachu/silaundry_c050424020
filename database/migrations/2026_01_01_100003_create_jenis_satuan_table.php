<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_satuan', function (Blueprint $table) {
            $table->char('ID_SATUAN', 4)->primary();
            $table->string('JENIS_SATUAN', 25)->nullable();
            $table->char('HARGA', 12)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_satuan');
    }
};
