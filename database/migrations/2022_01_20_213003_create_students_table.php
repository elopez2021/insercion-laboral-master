<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->BigInteger('identification');
            $table->date('birthday');
            $table->string('sex');
            $table->string('direction');
            $table->string('municipality');
            $table->string('province');
            $table->boolean('nationality'); // 0 if dominican, 1 if foreigner
            $table->BigInteger('homeNumber');
            $table->BigInteger('cellphone');
            $table->boolean('hasDrivingLicense');
            $table->boolean('hasVehicle');
            $table->BigInteger('graduationYear');
            $table->string('school');
            $table->string('grade');
            $table->string('enrollmentID');
            $table->string('career');
            $table->integer('experience');
            $table->string('workArea');
            $table->BigInteger('user_id')->nullable();
            $table->BigInteger('offer_id')->nullable();
            $table->string('cv_path')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('students');
    }
}
