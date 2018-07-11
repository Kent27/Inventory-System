<?php

use Illuminate\Database\Seeder;
use App\Client;
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Client::insert([
        ([
        	'name'=>'Hanaqua',
        ]),
        ([
        	'name'=>'Acek Bagan'
        ])
        ]);
    }
}
