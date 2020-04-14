<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$stamp= new DateTime;
        $data = [
            [
                'account_id' => '585966911',
                'status' => 1,
                'type' => 0,
            ],
            [
                'account_id' => '295732097',
                'status' => 1,
                'type' => 0,
            ],

        ];
        DB::table('accounts')->insert($data);
    }
}
