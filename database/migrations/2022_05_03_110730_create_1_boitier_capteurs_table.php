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
        Schema::create('1_boitier_capteurs', function (Blueprint $table) {
            $table->id();
            $table->string('id_capteur')->nullable();
            $table->integer('position')->nullable();
            $table->integer('position_tram')->nullable();
            $table->string('label')->nullable();
            $table->string('unite')->nullable();
            $table->date('date')->nullable();
            $table->boolean('state')->nullable();
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
        Schema::dropIfExists('1_boitier_capteurs');
    }
};
