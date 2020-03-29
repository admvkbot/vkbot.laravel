<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->char('status'); //0 - paused, 1 - active, 2 - archived
            $table->string('name');
            $table->text('description');
            $table->bigInteger('message_id')->unsigned();
            $table->bigInteger('list_id')->unsigned();
            $table->char('mess_per_day');
            $table->integer('activity_id')->unsigned()->default(1);
            $table->timestamps();

            $table->index('message_id');

            $table->foreign('message_id')
                ->references('id')
                ->on('first_messages')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index('list_id');

            $table->foreign('list_id')
                ->references('id')
                ->on('lists')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
