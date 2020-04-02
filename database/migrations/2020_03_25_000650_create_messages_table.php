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
            $table->bigInteger('own_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('direction'); // 0 - incoming, 1 - outgoing
            $table->text('message');
            // status - 0:'wait', 1:'prepared', 2:'sent', 3:'unread', 4:'read', 5:'archived'
            $table->char('status');
            $table->boolean('overview_status')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('messages');
    }
}
