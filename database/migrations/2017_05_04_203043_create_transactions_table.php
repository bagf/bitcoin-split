<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_split_id')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->string('wallet_address');
            $table->float('wallet_value')->default(0);
            $table->string('client_address');
            $table->float('client_percent');
            $table->float('owner_percent');
            $table->float('float')->default(0);
            $table->enum('payout_frequency', ['WEEKLY', 'MONHTLY']);
            $table->float('client_value');
            $table->float('owner_value');
            $table->boolean('command_successful')->nullable();
            $table->text('command_output')->nullable();
            $table->index(['client_split_id']);
            $table->index(['owner_id']);
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
        Schema::drop('transactions');
    }
}
