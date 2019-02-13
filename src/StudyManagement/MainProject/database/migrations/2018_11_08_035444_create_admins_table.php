<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('id');
            $table->string('fullName');
            $table->date('birthdate')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
