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
        Schema::create('detalle_arriendo_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idArriendoLocal');
            $table->timestamp('fechaMinimaPago');
            $table->timestamp('FechaMaximaPago');
            $table->decimal('valorArriendo', 9, 2)->default(0);
            $table->string('observacionPago', 50)->nullable();
            $table->boolean('pagado')->default(0);
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->boolean('activo')->default(1);
            $table->timestamps();

            
            $table->foreign('idArriendoLocal')->references('id')->on('arriendo_locales')->onDelete('no action');
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
        Schema::dropIfExists('detalle_arriendo_locales');
    }
};
