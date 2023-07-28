<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->char('pms_id',32);
            $table->char('name', 30);
            $table->char('cif', 12);
            $table->char('address', 50);
            $table->char('zip', 7);
            $table->integer('region_id')->unsigned();
            $table->integer('crm_integration_id')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('crm_integration_id')->references('id')->on('crm_integrations')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
