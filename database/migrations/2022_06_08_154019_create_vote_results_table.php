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
        Schema::create('vote_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vote_list_id');
            $table->unsignedBigInteger('vote_id')->unique();//外键关联vote的id
            $table->text('result');//结果用json存储
            $table->string('check_code');//校验码
            $table->timestamps();

            //$table->foreign('vote_id')->references('id')->on('votes');
            //$table->foreign('vote_list_id')->references('id')->on('vote_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_results');
    }
};
