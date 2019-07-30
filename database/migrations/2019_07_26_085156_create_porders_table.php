<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('keyPR');
            $table->string('date');
            $table->string('contractor');
            $table->string('formwork');
            $table->string('prequestconvert');
            $table->string('keystore');
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
        Schema::dropIfExists('porders');
    }
}