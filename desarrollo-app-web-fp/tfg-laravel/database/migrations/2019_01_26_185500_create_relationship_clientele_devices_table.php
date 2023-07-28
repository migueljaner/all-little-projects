<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipClienteleDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship_clientele_devices', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->integer('clientele_id')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('device_id')->references('id')->on('clientele_devices')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('clientele_id')->references('id')->on('clientele')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationship_clientele_devices');
    }
}
