<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('leasing')->nullable();
            $table->date('initLeasing')->nullable();
            $table->date('dateLeasing')->nullable();
            $table->integer('guarantee')->nullable();
            $table->date('initGuarantee')->nullable();
            $table->date('dateGuarantee')->nullable();
            $table->boolean('evolution')->nullable();
            $table->boolean('status_mail')->nullable();
            $table->timestamps();

            // foreign_keys
            $table->unsignedBigInteger('boitier_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
};
