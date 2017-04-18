<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gene_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('polymorphism', 255);
            $table->string('norm', 1);
            $table->string('change', 1);
            $table->integer('gene_id')->unsigned()->index();

            $table->foreign('gene_id')->references('id')->on('genes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gene_variants');
    }
}
