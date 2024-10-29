<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firstname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->float('markerLat')->nullable();
            $table->float('markerLng')->nullable();
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('siret')->nullable();
            $table->string('tva')->nullable();
            $table->boolean('password_changed')->default(false);
            $table->boolean('state')->default(0);
            $table->boolean('maintenance')->nullable();
            $table->text('comment')->nullable();
            $table->rememberToken();
            $table->timestamps();
            //foreign_keys
            $table->unsignedBigInteger('role_id');
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
        Schema::dropIfExists('users');
    }
}
