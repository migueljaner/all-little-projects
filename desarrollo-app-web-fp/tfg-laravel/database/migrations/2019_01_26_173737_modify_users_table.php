<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //Columns
            $table->boolean('is_enabled')->default(0)->after('name');
            $table->integer('profile_id')->unsigned()->nullable()->after('password');
            //Foreigns
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //Foreigns
            $table->dropForeign(['profile']);
            //Columns
            $table->dropColumn('is_enabled');
            $table->dropColumn('profile');
            //$table->dropColumn('first_login');
            //$table->dropColumn('last_login');
        });
    }
}
