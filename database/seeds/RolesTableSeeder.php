<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = [
    		['id' => 1, 'role' => 'Kasir'],
    		['id' => 2, 'role' => 'Pelayan']
    	];
    	foreach ($roles as $role) {
    		DB::table('roles')->insert($role);
    	}
    }
}
