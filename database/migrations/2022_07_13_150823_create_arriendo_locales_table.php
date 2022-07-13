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
        Schema::create('arriendo_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idLocal');
            $table->unsignedBigInteger('idCliente');
            $table->timestamp('fecha');
            $table->integer('meses');
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->boolean('activo')->default(1); 

            $table->timestamps();
            
            $table->foreign('idUsuarioCreacion')->references('id')->on('users')->onDelete('no action');
            $table->foreign('idLocal')->references('id')->on('locales')->onDelete('no action');
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arriendo_locales');
    }
};
