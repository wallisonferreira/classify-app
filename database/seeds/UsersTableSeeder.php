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
            'curador' => 0,
        ]);

        \App\User::create([
            'name' => 'Fulano da Silva',
            'email' => 'email@email.com',
            'password' => bcrypt('developer'),
            'curador' => 1,
        ]);
    }
}
