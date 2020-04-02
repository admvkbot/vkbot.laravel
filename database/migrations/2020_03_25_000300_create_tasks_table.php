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

            $table->Increments('id');
            $table->char('status'); //0 - paused, 1 - active, 2 - archived
            $table->string('name');
            $table->text('description');
            $table->char('actions_per_day');
            $table->Integer('activity_id')->unsigned()->default(1);
            $table->enum('type', ['spam', 'friendship']);
            $table->timestamps();

            $table->index('activity_id');

            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('no action')
                ->onUpdate('no action');

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
