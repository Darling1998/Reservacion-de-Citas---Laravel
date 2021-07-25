<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaDiagnosticoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta_diagnostico', function (Blueprint $table) {
            $table->id();

            //consula
            $table->unsignedBigInteger('consulta_id');
            $table->foreign('consulta_id')->references('id')->on('consulta')->onDelete('cascade');

            //receta_Detalle
            $table->unsignedBigInteger('diagnostico_id');
            $table->foreign('diagnostico_id')->references('id')->on('diagnosticos')->onDelete('cascade');

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
        Schema::dropIfExists('consulta_diagnostico');
    }
}
