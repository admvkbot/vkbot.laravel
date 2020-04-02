<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
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
                'name' => 'Standard',
                'description' => 'Москва-Питер, 3 минуты задержка, 10 минут между сообщениями, фейковой активности нет',
            ],
        ];
        DB::table('activities')->insert($data);
    }
}
