<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id('op_number');

            $table->string('measure');
            $table->timestamp('date_col');
            $table->string('obs')->nullable();
            $table->string('status');
            $table->integer('id_client')->unsigned();
            $table->integer('id_product')->unsigned();
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('samples');
    }
}
