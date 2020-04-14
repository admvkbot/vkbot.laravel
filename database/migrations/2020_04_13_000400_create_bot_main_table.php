<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_main', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigInteger('own_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->Integer('task_id')->unsigned();
            $table->boolean('status_work')->nullable();
            $table->integer('pid')->nullable(); //reserved
            $table->timestamps();

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

            $table->foreign('own_id')
                ->references('id')
                ->on('own_accounts')
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
        Schema::dropIfExists('bot_main');
    }
}
