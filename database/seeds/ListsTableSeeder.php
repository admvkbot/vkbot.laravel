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
                'name' => 'Список Шиндлера',
                'description' => 'Все бабы, у которых пизда поперек',
            ],
            [
                'name' => 'Список Второй',
                'description' => 'Самые глубокие глотки',
            ],
        ];
        DB::table('lists')->insert($data);
    }
}
