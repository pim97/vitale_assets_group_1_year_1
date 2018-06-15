<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloatScenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('float_scenarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('breach_location_id');
            $table->foreign('breach_location_id')->references('id')->on('breach_locations');
            $table->unsignedInteger('load_level_id');
            $table->foreign('load_level_id')->references('id')->on('load_levels');
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
        Schema::dropIfExists('float_scenarios');
    }
}
