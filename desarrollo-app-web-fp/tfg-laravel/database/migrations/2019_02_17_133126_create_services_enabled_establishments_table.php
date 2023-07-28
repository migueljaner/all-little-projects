<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesEnabledEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_enabled_establishments', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->integer('establishment_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_enabled_establishments');
    }
}
