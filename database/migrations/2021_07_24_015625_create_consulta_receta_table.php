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


            $table->date('fecha');
            $table->time('hora');


             //consula
             $table->unsignedBigInteger('consulta_id');
             $table->foreign('consulta_id')->references('id')->on('consulta')->onDelete('cascade');
 
            $table->string('cantidad');
            $table->string('nombre_medicamento');
            $table->text('indicaciones');
            


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
