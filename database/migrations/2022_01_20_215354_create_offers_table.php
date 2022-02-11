<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->BigInteger('salary');
            $table->string('location');
            $table->boolean('contractType'); // 0 if the contract is temporary, and 1 if the contract is permanent
            $table->string('schedule');
            $table->string('contactName');
            $table->string('contactMail');
            $table->BigInteger('contactNumber');
            $table->BigInteger('business_id')->nullable();
            $table->boolean('status'); // 0 if unfulfilled, 1 if already fulfilled.
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
        Schema::dropIfExists('offers');
    }
}
