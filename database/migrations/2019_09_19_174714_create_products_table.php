<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('keyPR');
            $table->string('Product_name');
            $table->integer('Product_number');
            $table->string('unit');
            $table->string('Store');
            $table->unsignedDecimal('price',8,2);
            $table->unsignedDecimal('product_sum',8,2);
            $table->unsignedDecimal('sumallprice',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
