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
        Schema::create('historial_cobros_garita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->date('fechainicio')->nullable();
            $table->date('fechaFin')->nullable();
            $table -> string('observacionCierre', 1024)->nullable();
            $table->decimal('valorRecaudado', 9, 2)->default(0);
            $table->boolean('cerrado')->default(0);
            $table->boolean('activo')->default(1);

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
        Schema::dropIfExists('historial_cobros_garita');
    }
};
