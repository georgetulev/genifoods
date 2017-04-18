<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToGeneVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gene_variants', function($table){
            $table->string('norm', 45)->change();
            $table->string('change', 45)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gene_variants', function($table){
            $table->string('norm', 1)->change();
            $table->string('change', 1)->change();
        });
    }
}
