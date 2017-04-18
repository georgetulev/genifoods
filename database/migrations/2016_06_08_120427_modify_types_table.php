<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function($table){

            $table->dropColumn('secondary_allele');
            $table->dropColumn('first_allele');

            $table->string('genotype', 255);
            $table->text('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('types', function($table){

            $table->dropColumn('genotype');

            $table->string('secondary_allele', 1);
            $table->string('first_allele', 1);
        });
    }
}
