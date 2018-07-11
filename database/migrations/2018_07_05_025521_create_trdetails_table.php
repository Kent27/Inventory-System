<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tr_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('driver_id')->unsigned();
            $table->string('plate_no')->nullable();
            $table->integer('in')->nullable()->default(0);
            $table->integer('out')->nullable()->default(0);
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tr_id')->references('id')->on('transactions')
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
        Schema::dropIfExists('trdetails');
    }
}
