<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCiudadToTalleresTable extends Migration
{
    public function up()
    {
        Schema::table('talleres', function (Blueprint $table) {
            $table->string('ciudad')->nullable()->after('direccion');
        });
    }

    public function down()
    {
        Schema::table('talleres', function (Blueprint $table) {
            $table->dropColumn('ciudad');
        });
    }
};
