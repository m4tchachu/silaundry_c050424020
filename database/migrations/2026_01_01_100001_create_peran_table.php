<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peran', function (Blueprint $table) {
            $table->char('ID_ROLE', 4)->primary();
            $table->string('NAMA_ROLE', 20)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peran');
    }
};
