<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('PO_ID');
            $table->string('keyPR');
            $table->string('Product_name');
            $table->integer('Product_number');
            $table->string('unit');
            $table->string('keystore');
            $table->unsignedDecimal('price',8,2);
            $table->unsignedDecimal('product_sum',8,2);
            $table->unsignedDecimal('sumofprice',8,2);
            $table->string('status');
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
        Schema::dropIfExists('pr_stores');
    }
}
