<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_option', function (Blueprint $table) {
            $table->id();
            $table->string('value',50);//选项内容
            $table->unsignedBigInteger('vote_id');//对应的投票id
            $table->timestamps();

            //$table->foreign('vote_id')->references('id')->on('vote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_option');
    }
};
