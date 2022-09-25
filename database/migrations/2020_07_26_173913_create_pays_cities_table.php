<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays_cities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('pays_id')->unsigned()->nullable();
            $table->foreign('pays_id')->references('id')
                  ->on('pays')->onDelete('cascade');
                  
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')
                  ->on('city')->onDelete('cascade');

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
        Schema::dropIfExists('pays_cities');
    }
}
