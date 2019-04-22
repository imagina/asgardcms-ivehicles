<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvehiclesVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivehicles__vehicles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('mileage')->nullable();
            $table->text('engine')->nullable();
            $table->double('price',100,2)->default(0);
            $table->text('address')->nullable();
            $table->integer('brand_id')->unisigne();
            $table->integer('model_id')->unisigne();
            $table->integer('fuel')->unisigne()->defailt(0);
            $table->integer('transmission')->unisigne()->default(0);
            $table->integer('owner_id')->unisigne();
            $table->integer('status')->unisigne();
            $table->integer('year')->nullable();
            $table->text('options')->nullable();
           // $table->foreign('brand_id')->references('id')->on('ivehicles__brands')->onDelete('cascade');
            //$table->foreign('model_id')->references('id')->on('ivehicles__models')->onDelete('cascade');
            //$table->foreign('owner_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            // Your fields
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
        Schema::dropIfExists('ivehicles__vehicles');
    }
}
