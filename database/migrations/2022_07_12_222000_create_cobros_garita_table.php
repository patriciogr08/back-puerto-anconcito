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
        Schema::create('cobros_garita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idTipoVehiculo');
            $table->decimal('valor', 9, 2)->default(0);
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->boolean('cerrado')->default(0);
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->boolean('activo')->default(1);
            $table->timestamps();

            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('no action');
            $table->foreign('idTipoVehiculo')->references('id')->on('parametros')->onDelete('no action');
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
        Schema::dropIfExists('cobros_garita');
    }
};
