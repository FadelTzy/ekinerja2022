<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pks', function (Blueprint $table) {
            $table->id();
            $table->string('id_mn');
            $table->string('periode');
            $table->string('id_peg');
            $table->string('skp')->nullable();
            $table->string('perilaku')->nullable();
            $table->string('idebaru')->nullable();
            $table->string('ak')->nullable();
            $table->string('predikat')->nullable();
            $table->string('kinerja')->nullable();
            $table->string('tgl_penilaian')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pks');
    }
}
