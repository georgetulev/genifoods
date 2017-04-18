<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TypeColumnForeingColumnRenamedToVariantId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function($table){
            $table->renameColumn('gene_variant_id', 'variant_id');
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
            $table->renameColumn('variant_id', 'gene_variant_id');
        });
    }
}
