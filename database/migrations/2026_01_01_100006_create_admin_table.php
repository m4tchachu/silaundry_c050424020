<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->char('ID_ADMIN', 5)->primary();
            $table->char('ID_ROLE', 4);
            $table->string('NAMA_ADMIN', 30)->nullable();
            $table->string('USERNAME', 20)->nullable();
            $table->string('PASSWORD', 12)->nullable();
            $table->char('NO_TELP', 13)->nullable();
            $table->string('STATUS', 10)->nullable();

            $table->foreign('ID_ROLE')->references('ID_ROLE')->on('peran')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
