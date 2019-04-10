<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('locale')->nullable();
            $table->longtext('content')->nullable();
            $table->string('customField1')->nullable();
            $table->string('customField2')->nullable();
            $table->string('customField3')->nullable();
            $table->string('customField4')->nullable();
            $table->string('customField5')->nullable();
            $table->string('customField6')->nullable();
            $table->string('customField7')->nullable();
            $table->string('customField8')->nullable();
            $table->string('customField9')->nullable();
            $table->string('customField10')->nullable();
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
        Schema::dropIfExists('custom_fields');
    }
}
