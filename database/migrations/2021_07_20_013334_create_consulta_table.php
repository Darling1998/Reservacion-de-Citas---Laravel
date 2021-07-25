<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->id();
            $table->text('motivo')->nullable();
            $table->float('peso')->nullable();
            $table->string('presian_arterial')->nullable();
            $table->float('talla')->nullable();
            $table->integer('temperatura')->nullable();

           
            $table->unsignedBigInteger('cita_id');
            $table->foreign('cita_id')->references('id')->on('citas')->onDelete('cascade');

            //HCE
            $table->unsignedBigInteger('hce_id');
            $table->foreign('hce_id')->references('id')->on('hce')->onDelete('cascade');
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
        Schema::dropIfExists('consulta');
    }
}
