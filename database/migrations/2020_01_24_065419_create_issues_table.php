<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('help_category_id');
            $table->unsignedTinyInteger('help_status_id');
            $table->unsignedBigInteger('user_id');
            $table->string('subject');
            $table->timestamps();

            $table->foreign('help_category_id')->references('id')->on('help_categories');
            $table->foreign('help_status_id')->references('id')->on('help_statuses');
            $table->foreign('user_id')->references('id')->on('users');
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
