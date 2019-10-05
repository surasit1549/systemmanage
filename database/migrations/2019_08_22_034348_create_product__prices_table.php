<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Cat_ID');
            $table->string('Store');
            $table->string('Product');
            $table->integer('Price');
            $table->timestamp('updated_product');
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
        Schema::dropIfExists('product__prices');
    }
}
