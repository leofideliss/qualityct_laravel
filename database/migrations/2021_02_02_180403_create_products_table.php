<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('color');
            $table->string('article');
            $table->string('thickness');
            $table->integer('id_client')->unsigned();
            $table->integer('id_segment')->unsigned();
            $table->integer('id_leather_type')->unsigned();
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_segment')->references('id')->on('segments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_leather_type')->references('id')->on('leather_types')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}
