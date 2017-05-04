<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerIdClientSplitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_splits', function (Blueprint $table) {
            $table->integer('owner_id')->unsigned()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_splits', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });
    }
}
