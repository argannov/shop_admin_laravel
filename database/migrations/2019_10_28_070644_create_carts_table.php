<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('price');
            $table->integer('currency');
            $table->integer('weight');
            $table->string('weight_value');
            $table->integer('quantity');
            $table->string('can_buy',1);
            $table->string('discount_name');
            $table->string('discount_coupon');
            $table->string('reserved');
            $table->dateTime('date_insert');
            $table->dateTime('date_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
