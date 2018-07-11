<?php

use Illuminate\Database\Seeder;
use App\Driver;
class DriversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Driver::insert([
        	([
        		'name'=>'Supir 1'
        	]),
        	([
        		'name'=>'Supir 2'
        	])
        ]);
    }
}
