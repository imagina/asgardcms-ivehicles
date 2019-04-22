<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvehiclesVehicleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivehicles__vehicle_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->text('slug');
            $table->string('metatitle')->nullable();
            $table->text('metakeywords')->nullable();
            $table->text('metadescription')->nullable();
            $table->integer('vehicle_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['vehicle_id', 'locale']);
            $table->foreign('vehicle_id')->references('id')->on('ivehicles__vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivehicles__vehicle_translations', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
        });
        Schema::dropIfExists('ivehicles__vehicle_translations');
    }
}
