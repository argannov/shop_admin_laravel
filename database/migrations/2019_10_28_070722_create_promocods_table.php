<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('discount_id');
            $table->string('active',1);
            $table->string('coupon');
            $table->dateTime('date_apply');
            $table->string('description');
            $table->float('modified_by');
            $table->dateTime('date_create');
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
        Schema::dropIfExists('promocods');
    }
}
