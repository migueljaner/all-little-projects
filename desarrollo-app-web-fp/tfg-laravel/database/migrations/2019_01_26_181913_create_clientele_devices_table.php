<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteleDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientele_devices', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->char('hostname', 30)->nullable();
            $table->char('mac', 30);
            $table->char('operation_system', 50)->nullable();
            $table->char('version', 10)->nullable();
            $table->char('maker', 10)->nullable();
            $table->integer('last_proprietor')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('last_proprietor')->references('id')->on('clientele')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientele_devices');
    }
}
