<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIvehiclesModelTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ivehicles__model_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->integer('model_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['model_id', 'locale']);
            $table->foreign('model_id')->references('id')->on('ivehicles__models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ivehicles__model_translations', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
        });
        Schema::dropIfExists('ivehicles__model_translations');
    }
}
