<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ph_logs', function (Blueprint $table) {
            $table->id();
            $table->float('phValue');
            $table->boolean('pumpPhPlus');
            $table->boolean('pumpPhMinus');
            $table->timestamps();
            //foreign_keys
            $table->unsignedBigInteger('ph_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ph_logs');
    }
}
