<?php

use Illuminate\Database\Seeder;

class BotMainSeeder extends Seeder
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
                'own_id' => 1,
                'user_id' => 1,
                'task_id' => 1,
            ],
            [
                'own_id' => 2,
                'user_id' => 2,
                'task_id' => 2,
            ],
        ];
        DB::table('bot_main')->insert($data);

    }
}
