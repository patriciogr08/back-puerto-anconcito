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
        Schema::create('bitacora_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modulo', 1024);
            $table->string('metodoHttp', 25);
            $table->string('servicio', 1024);
            $table->string('descripcion', 1024);
            $table->string('referencias', 1024)->nullable();
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->string('ip', 30);
            $table->timestamps();

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
        Schema::dropIfExists('bitacora_servicios');
    }
};
