<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->Increments('id');
            $table->bigInteger('own_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('status')->default(0); // 0 - new, 1 - viewed, 2 - reject
            $table->boolean('direction'); // 1 - outgoing, 0 - incoming,
            $table->timestamps();
            $table->timestamp('done_at')->nullable();

            $table->foreign('own_id')
                ->references('id')
                ->on('own_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('accounts')
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
        Schema::dropIfExists('friends');
    }
}
