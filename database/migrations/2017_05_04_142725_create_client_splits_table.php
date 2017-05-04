<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientSplitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_splits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wallet_address');
            $table->float('wallet_value', 20, 10)->default(0);
            $table->string('client_address');
            $table->float('client_percent');
            $table->float('owner_percent');
            $table->float('float', 20, 10)->default(0);
            $table->enum('payout_frequency', ['WEEKLY', 'MONTHLY']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_splits');
    }
}
