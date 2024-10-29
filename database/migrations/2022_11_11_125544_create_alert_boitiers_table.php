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
        Schema::create('alert_boitiers', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();
            $table->date('datetime');
            $table->timestamps();

            // foreign_keys
            $table->unsignedBigInteger('boitier_id');
            $table->unsignedBigInteger('alert_boitier_list_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alert_boitiers');
    }
};
