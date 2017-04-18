<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('types')) {
            Schema::drop('types');
        }

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 45);
            $table->string('first_allele', 1);
            $table->string('secondary_allele', 1);
            $table->integer('gene_variant_id')->unsigned()->index();

            $table->foreign('gene_variant_id')
                  ->references('id')->on('gene_variants')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('types');
    }
}
