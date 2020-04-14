<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnAccountsToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('own_accounts_to_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigInteger('own_id')->unsigned();
            $table->Integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('own_id')
                ->references('id')
                ->on('own_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('own_accounts_to_categories');
    }
}
