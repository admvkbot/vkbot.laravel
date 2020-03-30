<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->Increments('id');
            $table->Integer('task_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->timestamps();

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
        Schema::dropIfExists('lists');
    }
}
