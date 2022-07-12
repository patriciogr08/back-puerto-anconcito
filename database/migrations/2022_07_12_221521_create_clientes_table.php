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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTipoIdentificacion');
            $table->string('identificacion', 20)->unique();
            $table->string('apellidos', 100);
            $table->string('nombres', 100);
            $table->timestamp('fechaRegistro')->nullable();
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->boolean('activo')->default(1);
            $table->timestamps();
            
            $table->foreign('idTipoIdentificacion')->references('id')->on('parametros')->onDelete('no action');
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
        Schema::dropIfExists('clientes');
    }
};
