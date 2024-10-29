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
        Schema::create('1_boitier_datas', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->integer('capteur1_data');
            $table->integer('capteur1_id_capt');
            $table->integer('capteur2_data');
            $table->integer('capteur2_id_capt');
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
        Schema::dropIfExists('1_boitier_datas');
    }
};
