<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name', 255);
            $table->date('birthdate')->nullable();
            $table->text('result');
            $table->text('comments');
            $table->string('identity_number', 255);
            $table->text('reason');
            $table->string('requested_by', 255);
            $table->string('executed_by', 255);
            $table->string('supervised_by', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('analysis');
    }
}
