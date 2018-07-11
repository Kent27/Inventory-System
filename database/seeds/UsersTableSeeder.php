<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::insert([
        ([
        	'name' => 'Kent',
        	'email' => 'kent@gmail.com',
        	'password' => Hash::make('kent'),
            'position' => 'PROJECTADMIN',
        ]),
        ([
        	'name' => 'Steven',
        	'email' => 'steven@gmail.com',
        	'password' => Hash::make('steven'),
            'position' => 'USER'
        ])
        ]);
    }
}
