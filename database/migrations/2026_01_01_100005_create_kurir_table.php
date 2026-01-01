<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kurir', function (Blueprint $table) {
            $table->char('ID_KURIR', 4)->primary();
            $table->string('NAMA_KURIR', 30)->nullable();
            $table->char('NO_TELP', 13)->nullable();
            $table->string('KENDARAAN', 25)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kurir');
    }
};
