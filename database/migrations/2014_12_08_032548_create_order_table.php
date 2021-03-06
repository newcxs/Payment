<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::dropIfExists('order');
        Schema::create('order', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->string('id', 32)->unique();
            $table->string('up_id', 64);
            $table->string('type', 32);
            $table->string('site_id', 16);
            $table->string('user_agent', 128);
            $table->string('callback_url', 128);
            $table->string('return_url', 128);
            $table->string('cash', 16);
            $table->string('hash', 32);
            $table->string('create_time', 16);
            $table->string('finish_time', 16);
            $table->string('status', 2); //0-Created 1-OK
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('order');
    }

}
