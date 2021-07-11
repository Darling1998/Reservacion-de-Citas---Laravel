<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('dia');
            $table->boolean('activo');
            $table->time('hora_inicio_mñn');
            $table->time('hora_fin_mñn');
            $table->time('hora_inicio_tarde');
            $table->time('hora_fin_tarde');

            $table->unsignedBigInteger('medico_id');

            $table->foreign('medico_id')->references('id')->on('medicos');
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
        Schema::dropIfExists('medico_horarios');
    }
}
