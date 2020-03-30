<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'task_id' => 1,
                'account' => '585966911',
                'direction' => 0,
                'message' => 'Норм',
                'status' => 'unread',
            ],
        ];
        DB::table('messages')->insert($data);

    }
}
