<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell__summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('employe_id')->unsigned();
            $table->foreign('employe_id')->references('id')->on('employees');
            $table->bigInteger('price_total');
            $table->bigInteger('discount_total');
            $table->bigInteger('total');
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
        Schema::dropIfExists('sell__summaries');
    }
}
