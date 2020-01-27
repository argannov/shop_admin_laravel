<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->string('email');
            $table->text('text');
            $table->unsignedTinyInteger('status_id')->default(1);
            $table->unsignedBigInteger('responding_user_id')->nullable();
            $table->unsignedBigInteger('issue_id')->nullable();
            $table->timestamps();

            $table->foreign('responding_user_id')->references('id')->on('users');
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('status_id')->references('id')->on('help_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
