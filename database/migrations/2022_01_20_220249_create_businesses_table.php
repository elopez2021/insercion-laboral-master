<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->BigInteger('RNC');
            $table->boolean('wantsAnonimity');
            $table->boolean('hasFormationDepartment');
            $table->string('economicalActivity');
            $table->string('industry');
            $table->string('enterpriseSize');
            $table->string('direction');
            $table->string('sector');
            $table->string('section');
            $table->string('municipality');
            $table->string('province');
            $table->string('countryArea');
            $table->BigInteger('mainCellphone');
            $table->BigInteger('directPhone');
            $table->string('contactName');
            $table->BigInteger('contactNumber');
            $table->string('contactEmail');
            $table->BigInteger('user_id')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
