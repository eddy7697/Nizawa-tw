<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('location');
            $table->string('experience')->nullable();
            $table->string('education')->nullable();
            $table->string('description');
            $table->string('number');
            $table->string('department');
            $table->string('paymentRange')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('isTop')->default(false);
            $table->boolean('isShow')->default(false);
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
        Schema::dropIfExists('careers');
    }
}
