<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechRapportPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_rapport_photos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            //foreign_keys
            $table->unsignedBigInteger('boitier_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tech_rapport_photos');
    }
}
