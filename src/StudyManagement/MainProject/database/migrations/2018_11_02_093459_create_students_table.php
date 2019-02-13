<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            // $table->increments('id');
            $table->integer('id');
            $table->string('fullName');
            $table->date('birthdate')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('address')->nullable();
            $table->string('studentGroup')->nullable();
            $table->string('program');
            $table->integer('fee')->nullable();
            $table->float('CPA')->nullable();
            $table->integer('enrolCredit')->nullable();     //Tin chi dang ky
            $table->integer('completeCredit')->nullable();      //Tin chi hoan thanh
            $table->integer('who');
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
        Schema::dropIfExists('students');
    }
}
