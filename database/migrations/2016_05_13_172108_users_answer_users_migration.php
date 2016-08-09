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
            $table->integer('id_user_receiver')->unsigned()->index();
            $table->integer('id_announcement')->unsigned();

            $table->timestamps();

            $table->foreign('id_user_sender')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_user_receiver')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('users_answer_users', function ($table) {
            $table->dropForeign('users_answer_users_id_user_sender_foreign');
            $table->dropForeign('users_answer_users_id_user_receiver_foreign');
            $table->dropForeign('users_answer_users_id_announcement_foreign');
        });
        Schema::drop('users_answer_users');
    }
}
