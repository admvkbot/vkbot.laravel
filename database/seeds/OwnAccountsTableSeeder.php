<?php

use Illuminate\Database\Seeder;

class OwnAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'status' => 1,
            'login' => '37125342135',
            'password' => bcrypt('p98PUgp(UgPuGP(&G(P&Gp9'),
            'useragent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.5 Mobile/15E148 Safari/604.1',
            'description' => 'Hren',
        ];
        DB::table('own_accounts')->insert($data);
    }
}
