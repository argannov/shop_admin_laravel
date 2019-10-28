<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_carts');
            $table->integer('user_id');
            $table->string('payed',1);
            $table->dateTime('date_payed');
            $table->string('canceled');
            $table->dateTime('date_canceled');
            $table->integer('price');
            $table->integer('delivery_id');
            $table->integer('price_delivery');
            $table->string('currency');
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
        Schema::dropIfExists('orders');
    }
}
