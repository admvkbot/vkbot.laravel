<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksToAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_to_accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->Integer('task_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            //status_user_task 0: wait, 1: done, 2:error
            $table->char('status_user_task')->default(0);

            $table->index('user_id');
            $table->index(['task_id', 'status_user_task']);
            $table->index(['task_id', 'user_id'])->unique();

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('accounts')
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
        Schema::dropIfExists('tasks_to_accounts');
    }
}
