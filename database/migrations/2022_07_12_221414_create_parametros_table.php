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
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->string('nombre', 100);
            $table->string('descripcion', 1024)->nullable();
            $table->unsignedBigInteger('idTipo')->nullable();
            $table->unsignedBigInteger('idPadre')->nullable();
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->string('valor', 100)->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();
            
            $table->foreign('idTipo')->references('id')->on('parametros')->onDelete('no action');
            $table->foreign('idPadre')->references('id')->on('parametros')->onDelete('no action');
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
        Schema::dropIfExists('parametros');
    }
};
