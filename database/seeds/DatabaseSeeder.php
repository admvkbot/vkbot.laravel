<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(FirstMessagesTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(TasksToAccountsTableSeeder::class);
        $this->call(OwnAccountsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(TasksToAccountsTableSeeder::class);
        $this->call(FriendsTableSeeder::class);
    }
}
