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
        Schema::create('1_boitier_configs', function (Blueprint $table) {

            $table->id();
            $table->date('date');
            $table->boolean('coilStateA')->default(0);
            $table->boolean('coilStateB')->default(0);
            $table->boolean('generatorStateA')->default(0);
            $table->boolean('generatorStateB')->default(0);
            $table->string('last_co')->nullable();
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
        Schema::dropIfExists('1_boitier_configs');
    }
};
