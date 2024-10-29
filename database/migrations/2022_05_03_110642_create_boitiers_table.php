<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoitiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boitiers', function (Blueprint $table) {
            $table->id();
            $table->string('noSerie')->nullable();
            $table->date('dateActivation')->nullable();
            $table->date('firstConnect')->nullable();
            $table->date('lastUpdate')->nullable();
            $table->date('lastMoved')->nullable();
            $table->integer('ConnectionTimeLimit')->nullable();
            $table->string('versionSoftware')->nullable();
            $table->string('language')->nullable();
            $table->string('customerName')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('state')->nullable();
            $table->boolean('isOpen')->nullable();
            $table->boolean('phModule')->nullable();
            $table->boolean('hasGsm')->nullable();
            $table->boolean('modeBoost')->nullable();
            $table->boolean('coilStateA')->default(0);
            $table->boolean('coilStateB')->default(0);
            $table->boolean('generatorStateA')->default(0);
            $table->boolean('generatorStateB')->default(0);
            $table->date('since_connect')->nullable();
            $table->string('moyen_co')->nullable();
            $table->float('markerLat')->nullable();
            $table->float('markerLng')->nullable();
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
            
            // foreign_keys
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boitiers');
    }
}
