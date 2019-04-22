<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvehiclesBrandTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivehicles__brand_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('slug');
            $table->text('description');

            $table->integer('brand_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['brand_id', 'locale']);
            $table->foreign('brand_id')->references('id')->on('ivehicles__brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivehicles__brand_translations', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
        });
        Schema::dropIfExists('ivehicles__brand_translations');
    }
}
