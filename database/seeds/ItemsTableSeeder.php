<?php

use Illuminate\Database\Seeder;
use App\Item;
use Carbon\Carbon;
class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Item::insert([
        ([
        	'name' => 'Balam',
        	'quantity' => '27800',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]),
        ([
        	'name' => 'Meranti Putih',
        	'quantity' => '35000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ])
        ]);
    }
}
