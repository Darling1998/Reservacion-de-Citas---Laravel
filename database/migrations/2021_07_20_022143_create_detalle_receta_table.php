<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleRecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_receta', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_indicacion');
            $table->foreign('id_indicacion')->references('id')->on('indicaciones_medicamentos')->onDelete('cascade');

            $table->unsignedBigInteger('id_descripcion');
            $table->foreign('id_descripcion')->references('id')->on('descripcion_medicamentos')->onDelete('cascade');


            $table->unsignedBigInteger('consulta_id');
            $table->foreign('consulta_id')->references('id')->on('consulta')->onDelete('cascade');


            

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
        Schema::dropIfExists('detalle_receta');
    }
}
