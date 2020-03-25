<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('own_accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->Integer('rule_id')->unsigned();
            $table->enum('write_status', ['allow', 'deny']);
            $table->string('name');
            $table->string('login');
            $table->string('password');
            $table->date('birthday');
            $table->text('useragent');
            $table->dateTime('last_send');
            $table->timestamps();

            $table->index('rule_id');

            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
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
        Schema::dropIfExists('own_accounts');
    }
}
