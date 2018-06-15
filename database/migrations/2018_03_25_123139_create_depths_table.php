<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depths', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('asset_id')->nullable();
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');

            $table->unsignedInteger('float_scenario_id')->nullable();
            $table->foreign('float_scenario_id')->references('id')->on('float_scenarios')->onDelete('cascade');

            $table->double('water_depth');
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
        Schema::dropIfExists('depths');
    }
}
