<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
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
                'status' => 1,
                'name' => 'Первый',
                'description' => 'Пока хз что он делает вообще',
                'mess_per_day' => 50,
            ],
            [
                'status' => 1,
                'name' => 'Второй',
                'description' => 'Пока хз что он делает вообще тоже',
                'mess_per_day' => 50,
            ],
        ];
        DB::table('tasks')->insert($data);
    }
}
