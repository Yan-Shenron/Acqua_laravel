<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phs', function (Blueprint $table) {
            $table->id();
            $table->string('noSerie');
            $table->date('dateActivation');
            $table->date('firstConnect');
            $table->string('versionSoftware');
            $table->float('limitSupp');
            $table->float('limitInf');
            $table->float('volumeTotal');
            $table->float('deltaPh');
            $table->float('volumeSolution');
            $table->float('volumeInstruction');
            $table->text('comment');
            $table->boolean('state');
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
        Schema::dropIfExists('phs');
    }
}
