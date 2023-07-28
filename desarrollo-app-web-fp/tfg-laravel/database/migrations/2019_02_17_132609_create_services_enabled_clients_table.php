<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesEnabledClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_enabled_clients', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('services_enabled_clients');
    }
}
