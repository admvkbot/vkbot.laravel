<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->Increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('delay_start')->default(3)->unsigned(); //minutes
            $table->integer('delay_activities')->default(10)->unsigned(); //minutes
            $table->boolean('lenta_start')->default(0); //просмотр ленты после логина
            $table->boolean('lenta_delay')->default(0); //просмотр ленты между активностями
            $table->char('timezone')->default(3);
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
        Schema::dropIfExists('activities');
    }
}
