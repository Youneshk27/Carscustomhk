<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taller_id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->decimal('precio', 8, 2);
            $table->timestamps();

            $table->foreign('taller_id')->references('id')->on('talleres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicios');
    }
};
