<?php

use Illuminate\Database\Seeder;

class FirstMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stamp= new DateTime;
        $data = [
            [
                'task_id' => 1,
                'message' => 'Привет :) Как дела?',
                'added_at' => $stamp,
            ],
            [
                'task_id' => 2,
                'message' => 'Здравствуйте! До свидания!',
                'added_at' => $stamp,
            ],
        ];
        DB::table('first_messages')->insert($data);
    }
}
