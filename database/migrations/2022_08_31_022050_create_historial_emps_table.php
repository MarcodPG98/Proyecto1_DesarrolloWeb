<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_emp', function (Blueprint $table) {
            $table->id('id_historial_emp');
            $table->date('fecha');
            $table->time('hora');
            $table->bigInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->integer('tipo_entrada')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_emp');
    }
};
