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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();   
            $table->date('fecha');         
            $table->unsignedBigInteger('tipo_reporte_id')->default(1);
            $table->unsignedBigInteger('placa_id')->default(1);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->unsignedBigInteger('sede_id')->default(1);
            $table->unsignedBigInteger('periodo_id');
            $table->string('image');
            $table->boolean('estado');
            $table->timestamps();

            $table->foreign('tipo_reporte_id')->references('id')->on('tipo_reportes');
            $table->foreign('placa_id')->references('id')->on('vehiculos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('periodo_id')->references('id')->on('periodos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
};
