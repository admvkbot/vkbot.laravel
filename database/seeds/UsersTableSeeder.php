<?php

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Str;

    class UsersTableSeeder extends Seeder
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
                    'id' => 1,
                    'mail' => 'a@u.ru',
                    'password' => bcrypt('qpwoeiru'),
                ],
                [
                    'id' => 2,
                    'mail' => 'u@u.ru',
                    'password' => bcrypt(12345678),
                ],
            ];
            DB::table('users')->insert($data);
        }

    }
