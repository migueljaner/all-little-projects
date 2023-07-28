<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderToGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('genders')->insert([
            ['id' => 1, 'name' => 'man', 'created_at' => NOW()],
            ['id' => 2, 'name' => 'woman', 'created_at' => NOW()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('genders')
        ->where('id', '=', 1)
        ->orWhere('id', '=', 2)
        ->delete();
    }
}
