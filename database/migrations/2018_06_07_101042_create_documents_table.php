<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('filepath');
            $table->integer('tr_id')->unsigned()->nullable()->default(1);
            $table->integer('uploader_id')->unsigned()->nullable()->default(1);
            $table->timestamps();
            
            $table->foreign('tr_id')->references('id')->on('transactions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('uploader_id')->references('id')->on('users')
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
        Schema::dropIfExists('documents');
    }
}
