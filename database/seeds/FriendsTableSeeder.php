<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
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
            'own_id' => 1,
            'user_id' => 1,
            'status' => 0,
            'created_at' => $stamp,
        ];
        DB::table('friends')->insert($data);
    }
}
