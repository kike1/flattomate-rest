<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImageMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_main');
            $table->integer('id_announcement')->unsigned()->index();

            $table->timestamps();

            $table->foreign('id_announcement')->references('id')->on('announcements')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function ($table) {
            $table->dropForeign('images_id_announcement_foreign');
        });
        Schema::drop('images');
    }
}
