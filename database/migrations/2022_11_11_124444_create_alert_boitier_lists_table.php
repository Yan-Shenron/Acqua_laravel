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
        Schema::create('alert_boitier_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('valMin')->nullable();
            $table->integer('valMax')->nullable();
            $table->string('unite')->nullable();
            $table->boolean('isVisible')->nullable();
            $table->boolean('mailed')->nullable();
            $table->timestamps();
        });
    }

    //AFFICHAGE seulement

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alert_boitier_lists');
    }
};
