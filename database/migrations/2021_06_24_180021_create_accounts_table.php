<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            
            $table->unsignedBigInteger('user_id');
            $table->string('social_reason', 191);
            $table->string('fantasy_name', 191)->nullable();
            $table->integer('agency')->default('1');
            $table->integer('number');
            $table->float('amount', 8, 2);            
            $table->string('status', 191)->default('pedding');
            $table->integer('digit')->default('21');
            $table->enum('type_account', ['person', 'company']);
            
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
