<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('op_number')->unsigned();
            $table->bigInteger('id_experiment')->unsigned();
            $table->string('result');
            $table->boolean('approved');
            $table->timestamp('date_finish');
            $table->boolean('status');
            $table->boolean('specification'); // se for 0 valores da norma
            $table->foreign('op_number')->references('op_number')->on('samples')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_experiment')->references('id')->on('experiments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
