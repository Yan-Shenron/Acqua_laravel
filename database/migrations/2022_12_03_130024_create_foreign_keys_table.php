<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('boitiers', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('contracts', function(Blueprint $table) {
            $table->foreign('boitier_id')->references('id')->on('boitiers');
        });
        Schema::table('sims', function(Blueprint $table) {
            $table->foreign('boitier_id')->references('id')->on('boitiers');
        });
        Schema::table('phs', function(Blueprint $table) {
            $table->foreign('boitier_id')->references('id')->on('boitiers');
        });
        Schema::table('ph_logs', function(Blueprint $table) {
            $table->foreign('ph_id')->references('id')->on('phs');
        });
        Schema::table('locations', function(Blueprint $table) {
            $table->foreign('boitier_id')->references('id')->on('boitiers');
        });
        // Schema::table('tech_rapports', function(Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users');
        //     $table->foreign('boitier_id')->references('id')->on('boitiers');
        // });
        Schema::table('tech_rapport_photos', function(Blueprint $table) {
            $table->foreign('boitier_id')->references('id')->on('boitiers');
        });
        Schema::table('alert_boitiers', function(Blueprint $table) {
            $table->foreign('boitier_id')->references('id')->on('boitiers');
            $table->foreign('alert_boitier_list_id')->references('id')->on('alert_boitier_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
