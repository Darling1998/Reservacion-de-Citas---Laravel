<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id();
            $table->text('antecedentes_personales');
            $table->text('historia_personal');
 
            $table->integer('menarquia');
            $table->integer('ciclos');
            $table->date('fecha_ultima_menstruacion');
            $table->integer('gestas');
            $table->integer('cesareas');
            $table->integer('abortos');
            $table->integer('hijos');

            $table->boolean('activo');
            $table->text('habitos_toxicos');
            $table->text('examen_funcional');

            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');

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
        Schema::dropIfExists('antecedentes');
    }
}
