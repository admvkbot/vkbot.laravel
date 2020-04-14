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
            $table->char('status'); //0 - off, 1 - active, 2 - done, 3 - archived
            $table->string('name');
            $table->text('description');
            $table->Integer('by_categories')->nullable();
            $table->char('actions_per_day');
            $table->Integer('activity_id')->unsigned()->default(1);
            $table->enum('type', ['spam', 'friendship']);
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
