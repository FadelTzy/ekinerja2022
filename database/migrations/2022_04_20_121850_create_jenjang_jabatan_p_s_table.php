<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenjangJabatanPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenjang_jabatan_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('jenjang');
            $table->string('id_jabatan');
            $table->string('level_max')->nullable();
            $table->string('level_min')->nullable();
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
        Schema::dropIfExists('jenjang_jabatan_p_s');
    }
}
