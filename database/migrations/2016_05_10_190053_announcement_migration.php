<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->dateTime('availability');
            $table->integer('min_stay');
            $table->float('price');
            $table->boolean('is_visible');
            $table->boolean('is_shared_room');
            $table->boolean('is_private_room');

            $table->integer('id_accommodation')->unsigned()->onDelete('cascade');
            $table->foreign('id_accommodation')->references('id')->on('accommodations');
            $table->integer('id_user')->unsigned()->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users');

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
        Schema::drop('announcements');
    }
}
