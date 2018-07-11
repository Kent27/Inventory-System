<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('user_id')->length(10)->unsigned()->nullable();
            $table->integer('client_id')->length(10)->unsigned()->nullable();
            $table->integer('driver_id')->length(10)->unsigned()->nullable();
            $table->text('address');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('zipcode');

            $table->timestamps();

            //set foreign keys
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
