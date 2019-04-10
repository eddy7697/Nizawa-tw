<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('productParent');
            $table->string('subSerialNumber');
            $table->string('subProductGuid');
            $table->string('subTitle');
            $table->string('subQuantity');
            $table->integer('subPrice');
            $table->integer('subDiscountPrice')->nullable();
            $table->longtext('subDescription')->nullable();
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
        Schema::dropIfExists('sub_products');
    }
}
