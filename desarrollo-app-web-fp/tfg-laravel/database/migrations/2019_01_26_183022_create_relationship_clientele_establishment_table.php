<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipClienteleEstablishmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship_clientele_establishment', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->integer('establishment_id')->unsigned();
            $table->integer('clientele_id')->unsigned();
            $table->boolean('delete')->default(0);
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
        Schema::dropIfExists('relationship_clientele_establishment');
    }
}
