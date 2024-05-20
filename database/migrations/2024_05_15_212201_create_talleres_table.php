<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalleresTable extends Migration
{
    public function up()
    {
        Schema::create('talleres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('contacto');
            $table->text('descripcion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->time('horario_apertura')->nullable();
            $table->time('horario_cierre')->nullable();
            $table->json('dias_laborables')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('talleres');

        Schema::table('talleres', function (Blueprint $table) {
            $table->dropColumn(['lat', 'lng', 'horario_apertura', 'horario_cierre', 'dias_laborables']);
        });
    }
}