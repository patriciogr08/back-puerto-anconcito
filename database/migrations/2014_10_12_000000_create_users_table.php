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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 20);
            $table->string('primerNombre', 20);
            $table->string('segundoNombre', 20);
            $table->string('primerApellido', 20);
            $table->string('segundoApellido', 20);
            $table->string('email')->unique();
            $table->text('fotoPerfil')->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
