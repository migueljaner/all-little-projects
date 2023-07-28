<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientele', function (Blueprint $table) {
            //Columns
            $table->increments('id');
            $table->char('name', 30);
            $table->char('surname', 30);
            $table->char('email', 100);
            $table->boolean('email_is_useds')->default(0);
            $table->integer('nationality')->unsigned();
            $table->dateTime('birthdate');
            $table->boolean('is_minor')->default(0);
            $table->integer('gender_id')->unsigned();
            $table->timestamps();
            //Foreigns
            $table->foreign('nationality')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clienteles');
    }
}
