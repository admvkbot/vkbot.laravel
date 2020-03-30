<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->Integer('task_id')->unsigned();
            $table->string('account');
            $table->boolean('direction'); // 0 - incoming, 1 - outgoing
            $table->text('message');
            $table->enum('status', ['paused', 'prepared', 'sent', 'unread', 'read', 'archived']);
            $table->dateTime('created')->nullable();
            $table->dateTime('sent')->nullable();
            $table->dateTime('received')->nullable();
            $table->dateTime('was_read')->nullable();

            $table->index('task_id');

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
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
        Schema::dropIfExists('messages');
    }
}
