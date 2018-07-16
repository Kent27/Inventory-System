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
            'phone_number'=>'081234567',
            'bank_name'=>'BCA',
            'account_name'=>'Kimin',
            'account_number'=>'12345678',
            'address'=>'lippo karawaci'
        ]),
        ([
        	'name'=>'Acek Bagan',
            'phone_number'=>'081254321',
            'bank_name'=>'Mandiri',
            'account_name'=>'Acek',
            'account_number'=>'87654321',
            'address'=>'Poris Indah'
        ])
        ]);
    }
}
