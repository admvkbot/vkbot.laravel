<?php

use Illuminate\Database\Seeder;

class ListsTableSeeder extends Seeder
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
                'name' => 'Список Шиндлера',
                'description' => 'Все бабы, у которых пизда поперек',
            ],
            [
                'task_id' => 2,
                'name' => 'Список Второй',
                'description' => 'Самые глубокие глотки',
            ],
        ];
        DB::table('lists')->insert($data);
    }
}
