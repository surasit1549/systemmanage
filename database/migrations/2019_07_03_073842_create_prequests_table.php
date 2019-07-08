<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prequests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('keyPR');
            $table->date('date');
            $table->string('contractor');
            $table->string('formwork');
            $table->string('prequestconvert');
            $table->string('productname');
            $table->integer('productnumber');
            $table->string('unit');
            $table->string('keystore');
            $table->integer('price');
            $table->integer('sum');
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
        Schema::dropIfExists('prequests');
    }
}
