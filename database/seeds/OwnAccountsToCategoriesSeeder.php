<?php

use Illuminate\Database\Seeder;

class OwnAccountsToCategoriesSeeder extends Seeder
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
                'own_id' => 1,
                'category_id' => 1,
            ],
            [
                'own_id' => 1,
                'category_id' => 2,
            ],
        ];
        DB::table('own_accounts_to_categories')->insert($data);
    }
}
