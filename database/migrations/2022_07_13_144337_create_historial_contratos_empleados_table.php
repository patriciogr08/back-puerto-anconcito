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
        Schema::create('historial_contratos_empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idControlEmpleados');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->boolean('activo')->default(1); 

            $table->timestamps();

            $table->foreign('idControlEmpleados')->references('id')->on('control_empleados')->onDelete('no action');
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
        Schema::dropIfExists('historial_contratos_empleados');
    }
};
