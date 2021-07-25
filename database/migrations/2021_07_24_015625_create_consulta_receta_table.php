<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaRecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta_receta', function (Blueprint $table) {
            $table->id();

             //consula
             $table->unsignedBigInteger('consulta_id');
             $table->foreign('consulta_id')->references('id')->on('consulta')->onDelete('cascade');
 
             //receta_Detalle
             $table->unsignedBigInteger('detalle_receta_id');
             $table->foreign('detalle_receta_id')->references('id')->on('detalle_receta')->onDelete('cascade');
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
        Schema::dropIfExists('consulta_receta');
    }
}
