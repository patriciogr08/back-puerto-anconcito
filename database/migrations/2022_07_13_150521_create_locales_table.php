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
        Schema::create('locales', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 50)->nullable();
            $table->decimal('valorArriendo', 9, 2)->default(0);
            $table->unsignedBigInteger('idUsuarioCreacion');
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
        Schema::dropIfExists('locales');
    }
};
