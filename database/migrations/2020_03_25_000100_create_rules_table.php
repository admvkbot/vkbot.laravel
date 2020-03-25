<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->Increments('id');
            $table->string('title')->unique();
            $table->char('age_min');
            $table->char('age_max');
            $table->enum('sex', ['-', 'male', 'female'])->default('-');
            $table->string('region');
            $table->char('own_age_min');
            $table->char('own_age_max');
            $table->enum('own_sex', ['-', 'male', 'female'])->default('-');
            $table->string('own_region');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rules');
    }
}
