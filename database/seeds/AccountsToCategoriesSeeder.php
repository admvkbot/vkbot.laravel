<?php

use Illuminate\Database\Seeder;

class AccountsToCategoriesSeeder extends Seeder
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
                'user_id' => 1,
                'category_id' => 1,
            ],
            [
                'user_id' => 1,
                'category_id' => 2,
            ],
        ];
        DB::table('accounts_to_categories')->insert($data);

    }
}
