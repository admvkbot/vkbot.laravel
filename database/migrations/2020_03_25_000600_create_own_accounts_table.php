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
            $table->boolean('status');
            $table->string('description')->nullable();
            $table->string('login');
            $table->string('password');
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_action_at')->nullable();
            $table->text('useragent');
            $table->text('cookie')->nullable();
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
        Schema::dropIfExists('own_accounts');
    }
}
