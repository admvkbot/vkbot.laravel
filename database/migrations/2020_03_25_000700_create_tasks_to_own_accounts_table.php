<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksToOwnAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_to_own_accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->Increments('id');
            $table->bigInteger('own_id')->unsigned();
            $table->Integer('task_id')->unsigned();

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('own_id')
                ->references('id')->on('own_accounts')
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
        Schema::dropIfExists('tasks_to_own_accounts');
    }
}
