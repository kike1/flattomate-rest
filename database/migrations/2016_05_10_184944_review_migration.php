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
            $table->foreign('id_user_wrote')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_user_received')->unsigned()->index();
            $table->foreign('id_user_received')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('reviews');
    }
}
