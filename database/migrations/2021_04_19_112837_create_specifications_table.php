<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->integer('id_client')->unsigned();
            $table->string('name');
            $table->bigInteger('id_uni')->unsigned();
            $table->string('min_value');
            $table->integer('id_product')->unsigned();
            $table->bigInteger('id_experiment')->unsigned();
            $table->foreign('id_uni')->references('id')->on('measures')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_experiment')->references('id')->on('experiments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('specifications');
    }
}