
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegionToRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('regions')->insert([
            ['id' => 1, 'name' => 'palma', 'province_id' => 1, 'created_at' => NOW()],
            ['id' => 2, 'name' => 'ibiza', 'province_id' => 1, 'created_at' => NOW()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('regions')
        ->where('id', '=', 1)
        ->orWhere('id', '=', 2)
        ->delete();
    }
}
