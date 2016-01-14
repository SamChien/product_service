<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Products;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('colors');
            $table->string('sizes');
            $table->text('content');
            $table->integer('price')->unsigned;
            $table->string('picture');
            $table->string('size_picture');
            $table->timestamps();
            $table->string('seller_id');
        });

        $prosJson = File::get(storage_path() . '/data/seed.json');
        $pros = json_decode($prosJson);
        foreach ($pros as $proData) {
            $pro = new Products;
            $pro->name = $proData->name;
            $pro->colors = '["black", "white"]';
            $pro->sizes = '["S", "M", "L"]';
            $pro->content = 'This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.This is a the content of the clothes.';
            $proData->price = str_replace('$', '', $proData->price);
            $pro->price = str_replace(',', '', $proData->price);
            $pro->picture = $proData->picture;
            if (isset($proData->{'size-picture'})) {
                $pro->size_picture = $proData->{'size-picture'};
            }
            $pro->seller_id = 'A1234';
            $pro->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
