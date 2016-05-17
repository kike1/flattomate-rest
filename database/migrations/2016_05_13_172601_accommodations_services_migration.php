<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccommodationsServicesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations_services', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_accommodation')->unsigned()->index();
            $table->foreign('id_accommodation')->references('id')->on('accommodations')->onDelete('cascade');
            $table->integer('id_service')->unsigned()->index();
            $table->foreign('id_service')->references('id')->on('services')->onDelete('cascade');

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
        Schema::drop('accommodations_services');
    }
}
