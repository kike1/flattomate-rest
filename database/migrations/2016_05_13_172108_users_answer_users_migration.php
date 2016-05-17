<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAnswerUsersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_answer_users', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_user_sender')->unsigned()->index();
            $table->foreign('id_user_sender')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_user_receiver')->unsigned()->index();
            $table->foreign('id_user_receiver')->references('id')->on('users')->onDelete('cascade');

            $table->integer('id_announcement')->unsigned();
            $table->foreign('id_announcement')->references('id')->on('announcements')->onDelete('cascade');

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
        Schema::drop('users_answer_users');
    }
}
