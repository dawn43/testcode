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
        $users = [
        	['name' => 'Fajar', 'email' => 'fajar@email.com', 'password' => bcrypt('password'), 'role_id' => 1],
        	['name' => 'Fahrurozi', 'email' => 'fahrurozi@email.com', 'password' => bcrypt('password'), 'role_id' => 2]
        ];

        foreach ($users as $user) {
        	DB::table('users')->insert($user);
        }
    }
}
