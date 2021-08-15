<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleReceta extends Migration
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

            $table->string('cantidad');
            $table->string('indicaciones');

            $table->unsignedBigInteger('receta_id');
            $table->foreign('receta_id')->references('id')->on('consulta_receta')->onDelete('cascade');

            $table->unsignedBigInteger('medicamento_id');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos')->onDelete('cascade');

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
