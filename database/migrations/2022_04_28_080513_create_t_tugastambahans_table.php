<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTugastambahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tugastambahans', function (Blueprint $table) {
            $table->id();
            $table->string('id_mn');
            $table->string('id_periode');
            $table->string('id_peg');
            $table->string('ikikuantitas')->nullable();
            $table->string('ikikualitas')->nullable();
            $table->string('ikiwaktu')->nullable();
            $table->string('tkuantitas')->nullable();
            $table->string('twaktu')->nullable();
            $table->string('tkualitas')->nullable();
            $table->string('tugas')->nullable();
            $table->string('rkuantitas')->nullable();
            $table->string('rwaktu')->nullable();
            $table->string('rkualitas')->nullable();
            $table->string('status')->nullable();
            $table->string('nilai_mutu')->nullable();
            $table->string('nilai_capaian')->nullable();
            $table->string('keterangan')->nullable();

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
        Schema::dropIfExists('t_tugastambahans');
    }
}
