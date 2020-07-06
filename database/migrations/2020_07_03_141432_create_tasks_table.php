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
            $table->id();
            $table->foreignId('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');

            $table->foreignId('performer_id')->nullable();
            $table->foreign('performer_id')->references('id')->on('users');

            $table->text('description');

            $table->foreignId('task_status_id');
            $table->foreign('task_status_id')->references('id')->on('task_statuses');

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
        Schema::dropIfExists('tasks');
    }
}
