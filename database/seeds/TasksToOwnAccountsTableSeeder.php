<?php

use Illuminate\Database\Seeder;

class TasksToOwnAccountsTableSeeder extends Seeder
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
                'task_id' => 1,
            ],
            [
                'own_id' => 1,
                'task_id' => 2,
            ],
        ];
        DB::table('tasks_to_own_accounts')->insert($data);
    }
}
