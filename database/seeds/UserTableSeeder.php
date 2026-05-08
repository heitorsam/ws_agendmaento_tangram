<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
        	'name'=> 'Rogerio',
        	'email' => 'rogerio25123@hotmail.com',
        	'password' => bcrypt('123456')

        ]);
    }
}
