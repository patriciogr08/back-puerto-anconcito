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
        Schema::create('control_empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEmpleado');
            $table->jsonb('cv')->nullable();
            $table->jsonb('referencias')->nullable();
            $table->boolean('renovacion')->default(0);
            $table->integer('mesesContrato');
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
            $table->boolean('activo')->default(1);    
            $table->unsignedBigInteger('idUsuarioCreacion');
                   
            $table->timestamps();

            $table->foreign('idEmpleado')->references('id')->on('users')->onDelete('no action');
            $table->foreign('idUsuarioCreacion')->references('id')->on('users')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_empleados');
    }
};
