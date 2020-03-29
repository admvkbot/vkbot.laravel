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
                'message' => 'Привет :) Как дела?',
            ],
            [
                'message' => 'Здравствуйте! До свидания!',
            ],
        ];
        DB::table('first_messages')->insert($data);
    }
}
