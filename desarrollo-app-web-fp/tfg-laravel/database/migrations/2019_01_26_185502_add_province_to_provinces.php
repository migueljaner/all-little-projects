<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProvinceToProvinces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('provinces')->insert([
            ['id' => 1, 'name' => 'baleares', 'country_id' => 1, 'created_at' => NOW()],
            ['id' => 2, 'name' => 'madrid', 'country_id' => 1, 'created_at' => NOW()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('provinces')
        ->where('id', '=', 1)
        ->orWhere('id', '=', 2)
        ->delete();
    }
}
