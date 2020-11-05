<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('tasks_id');
            $table->string('title');
            $table->string('description');
            $table->date('due-date');
            $table->string('state');
            $table->foreignId('tasks_user_id');
            $table->foreign('tasks_user_id')->references('id')->on('users');
            $table->dropForeign("task_user_id");
            $table->foreignId('board_id');
            $table->foreign("board_id")->references('id')->on('boards');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
