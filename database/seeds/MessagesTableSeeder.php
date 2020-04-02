<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stamp= new DateTime;
        $data = [
            [
                'own_id' => 1,
                'user_id' => 1,
                'direction' => 0,
                'message' => 'Норм',
                'status' => 3,
                'created_at' => $stamp,
            ],
        ];
        DB::table('messages')->insert($data);

    }
}
