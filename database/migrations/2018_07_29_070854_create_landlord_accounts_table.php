<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandlordAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlord_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id')->unsigned()->nullable();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->bigInteger('landlord_id')->unsigned();
            $table->foreign('landlord_id')->references('id')->on('masterfiles');
            $table->string('reference')->nullable();
            $table->string('transaction_type');
            $table->double('amount');
            $table->dateTime('date');
            $table->softDeletes();
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
        Schema::dropIfExists('landlord_accounts');
    }
}
