<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->timestamps();
            $table->string('mem_id');
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id')->references('id')->on('products');
        });
        DB::table('comments')->insert(array('content' => 'comments_content....', 'mem_id' => '1', 'pro_id' => '1'));
        DB::table('comments')->insert(array('content' => 'this is an another comment', 'mem_id' => '2', 'pro_id' => '1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
