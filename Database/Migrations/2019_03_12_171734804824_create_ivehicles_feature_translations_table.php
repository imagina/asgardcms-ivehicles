<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvehiclesFeatureTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivehicles__feature_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->integer('feature_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['feature_id', 'locale']);
            $table->foreign('feature_id')->references('id')->on('ivehicles__features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivehicles__feature_translations', function (Blueprint $table) {
            $table->dropForeign(['feature_id']);
        });
        Schema::dropIfExists('ivehicles__feature_translations');
    }
}
