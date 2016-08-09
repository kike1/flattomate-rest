<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviewMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('id_user_wrote')->unsigned()->index();
            $table->integer('id_user_received')->unsigned()->index();

            $table->timestamps();

            $table->foreign('id_user_wrote')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_user_received')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function ($table) {
            $table->dropForeign('reviews_id_user_wrote_foreign');
            $table->dropForeign('reviews_id_user_received_foreign');
        });
        Schema::drop('reviews');
    }
}
