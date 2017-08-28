<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Developer',
            'email' => 'developer@email.com',
            'password' => bcrypt('developer'),
        ]);
    }
}
