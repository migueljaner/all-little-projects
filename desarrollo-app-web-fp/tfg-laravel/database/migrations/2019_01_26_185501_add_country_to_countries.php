<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryToCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('countries')->insert([
            ['id' => 1, 'name' => 'es', 'created_at' => NOW()],
            ['id' => 2, 'name' => 'usa', 'created_at' => NOW()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('countries')
        ->where('id', '=', 1)
        ->orWhere('id', '=', 2)
        ->delete();
    }
}
