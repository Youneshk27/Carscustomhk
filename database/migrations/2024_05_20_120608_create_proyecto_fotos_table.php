<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyecto_fotos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taller_id');
            $table->string('foto');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('taller_id')->references('id')->on('talleres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_fotos');
    }
};
