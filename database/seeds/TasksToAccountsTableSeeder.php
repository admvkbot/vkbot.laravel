<?php

use Illuminate\Database\Seeder;

class TasksToAccountsTableSeeder extends Seeder
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
                'user_id' => 1,
            ],
            [
                'task_id' => 2,
                'user_id' => 1,
            ],
        ];
        DB::table('tasks_to_accounts')->insert($data);
    }
}
