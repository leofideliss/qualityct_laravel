<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street')->nullable();
            $table->integer('number')->nullable();
            $table->string('complements')->nullable();
            $table->string('CEP')->nullable();
            $table->string('neighborhoods')->nullable();
            $table->timestamps();
            $table->string('id_state')->nullable();
            // $table->foreign('id_state')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            $table->string('id_city')->nullable();
            // $table->foreign('id_city')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}