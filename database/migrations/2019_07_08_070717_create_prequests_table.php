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
            $table->string('date');
            $table->string('contractor');
            $table->string('formwork');
            $table->string('prequestconvert');
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
