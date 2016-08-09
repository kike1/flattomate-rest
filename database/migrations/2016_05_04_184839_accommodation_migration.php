<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccommodationMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('n_people');
            $table->integer('n_beds');
            $table->integer('n_bathrooms');
            $table->integer('n_rooms');
            $table->string('location');
            $table->integer('id_announcement')->unsigned();
            $table->foreign('id_announcement')->references('id')->on('announcements');

            $table->timestamps();

        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->foreign('id_accommodation')->references('id')->on('accommodations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accommodations', function ($table) {
            $table->dropForeign('accommodations_id_announcement_foreign');
        });
        Schema::drop('accommodations');
    }
}
