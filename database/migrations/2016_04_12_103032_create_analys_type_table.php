<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analys_type', function (Blueprint $table) {
            $table->integer('analys_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->primary(['analys_id', 'type_id']);

            $table->foreign('analys_id')->references('id')->on('analysis')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('analys_type');
    }
}
