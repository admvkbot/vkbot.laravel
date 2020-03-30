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
        $data = [
            [
                'task_id' => 1,
                'message' => 'Привет :) Как дела?',
            ],
            [
                'task_id' => 2,
                'message' => 'Здравствуйте! До свидания!',
            ],
        ];
        DB::table('first_messages')->insert($data);
    }
}
