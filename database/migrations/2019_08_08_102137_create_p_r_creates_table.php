<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePRCreatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_r_creates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date');
            $table->string('contractor');
            $table->string('formwork');
            $table->string('prequestconvert');
            $table->string('productname');
            $table->integer('productnumber');
            $table->string('unit');
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
        Schema::dropIfExists('p_r_creates');
    }
}
