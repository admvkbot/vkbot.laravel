<?php

use Illuminate\Database\Seeder;

class TasksToCategoriesSeeder extends Seeder
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
                'category_id' => 1,
            ],
            [
                'task_id' => 2,
                'category_id' => 3,
            ],
        ];
        DB::table('tasks_to_categories')->insert($data);

    }
}
