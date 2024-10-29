<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechRapportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_rapports', function (Blueprint $table) {
            $table->id();
            $table->date('maintenanceDate');
            $table->string('time');
            $table->string('type');
            $table->text('comment');
            $table->timestamps();
            //foreign_keys
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('tech_rapports');
    }
}
