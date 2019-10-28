<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('category');
            $table->string('article');
            $table->string('slug');
            $table->string('body');
            $table->string('image_anons');
            $table->string('image_detail');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->integer('price');
            $table->integer('old_price');
            $table->string('sale');
            $table->string('status');
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
        Schema::dropIfExists('goods');
    }
}
