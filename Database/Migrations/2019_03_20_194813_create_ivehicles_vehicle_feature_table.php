<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvehiclesVehicleFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivehicles__vehicle_feature', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unisigne();
            $table->integer('feature_id')->unisigne();
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
        Schema::dropIfExists('ivehicles__vehicle_feature');
    }
}
