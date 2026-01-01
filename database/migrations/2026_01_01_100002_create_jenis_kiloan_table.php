<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_kiloan', function (Blueprint $table) {
            $table->char('ID_KILOAN', 6)->primary();
            $table->string('PAKET_KILOAN', 25)->nullable();
            $table->char('HARGA', 12)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_kiloan');
    }
};
