<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('norms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('id_uni')->unsigned();
            $table->string('min_value');
            $table->integer('id_segment')->unsigned();
            $table->integer('id_leather_type')->unsigned();
            $table->bigInteger('id_experiment')->unsigned();
            $table->foreign('id_uni')->references('id')->on('measures')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_segment')->references('id')->on('segments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_leather_type')->references('id')->on('leather_types')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('norms');
    }
}
