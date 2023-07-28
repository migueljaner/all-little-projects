<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteleVisitEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientele_visit_establishments', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->integer('establishment_id')->unsigned();
            $table->integer('clientele_id')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('clientele_visit_establishments');
    }
}
