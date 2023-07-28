<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->char('guid', 36);
            $table->char('name', 30);
            $table->char('address', 50);
            $table->char('zip', 7);
            $table->integer('client_id')->unsigned();
            $table->integer('categori_id')->unsigned();
            $table->integer('type_quality_id')->unsigned();
            $table->char('quality', 2);
            $table->integer('region_id')->unsigned();
            $table->char('average_stay', 6)->default(1);
            $table->timestamps();
            //Foreigns
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('categori_id')->references('id')->on('establishment_categories')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_quality_id')->references('id')->on('quality_types')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establishments');
    }
}
