<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('issue_id');
            $table->unsignedBigInteger('asked_user_id');
            $table->unsignedBigInteger('responding_user_id');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('asked_user_id')->references('id')->on('users');
            $table->foreign('responding_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_chats');
    }
}
