<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->char('name', 30);
            $table->char('surname', 30);
            $table->char('address', 50);
            $table->char('zip', 7);
            $table->integer('region_id')->unsigned();
            $table->char('phone', 12)->nullable();
            $table->char('mobile', 12);
            $table->integer('client_id')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
