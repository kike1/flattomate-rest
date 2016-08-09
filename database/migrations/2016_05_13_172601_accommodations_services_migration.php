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
            $table->integer('id_service')->unsigned()->index();
            $table->timestamps();

            $table->foreign('id_accommodation')->references('id')->on('accommodations')->onDelete('cascade');
            $table->foreign('id_service')->references('id')->on('services')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accommodations_services', function ($table) {
            $table->dropForeign('accommodations_services_id_accommodation_foreign');
            $table->dropForeign('accommodations_services_id_service_foreign');
        });

        Schema::drop('accommodations_services');
    }
}
