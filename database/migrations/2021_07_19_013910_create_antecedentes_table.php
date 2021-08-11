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
            $table->text('antecedentes_personales')->nullable();
            $table->text('historia_personal')->nullable();
 
            $table->integer('menarquia')->nullable();
            $table->integer('ciclos')->nullable();
            $table->date('fecha_ultima_menstruacion')->nullable();
            $table->integer('gestas')->nullable();
            $table->integer('cesareas')->nullable();
            $table->integer('abortos')->nullable();
            $table->integer('hijos')->nullable();

            $table->boolean('activo')->nullable();
            $table->text('habitos_toxicos')->nullable();
            $table->text('examen_funcional')->nullable();

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
