<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
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
                'title' => 'Жопки',
                'description' => 'Мужчины от 18 до 65',
            ],
            [
                'title' => 'Праздники',
                'description' => 'Контенгент, который хочет развлекаться',
            ],
            [
                'title' => 'Финансы',
                'description' => '',
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
