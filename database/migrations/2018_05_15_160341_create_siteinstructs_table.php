<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteinstructsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteinstructs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('access_level')->default('0');
            $table->text('requester_notes');
            $table->text('approver_notes')->nullable();
            $table->integer('requester_id')->unsigned();
            $table->integer('approver_id')->nullable();
            $table->string('status')->default("waiting");
            $table->timestamps();

            $table->foreign('requester_id')
            ->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siteinstructs');
    }
}
