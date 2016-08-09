<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAccommodationsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned()->index();
            $table->integer('id_accommodation')->unsigned()->index();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_accommodation')->references('id')->on('accommodations')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_accommodations', function ($table) {
            $table->dropForeign('users_accommodations_id_user_foreign');
            $table->dropForeign('users_accommodations_id_accommodation_foreign');
        });

        Schema::drop('users_accommodations');
    }
}
