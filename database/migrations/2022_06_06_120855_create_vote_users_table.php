<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 用户投票信息表
 * 记录用户每个投票选择结果
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vote_list_id');//投票活动id
            $table->unsignedBigInteger('vote_id');//投票id
            $table->unsignedBigInteger('option_id');//选项id
            $table->unsignedBigInteger('user_id');//用户id
            $table->string('check_code');//校验码
            $table->timestamps();

            //$table->foreign('vote_id')->references('id')->on('votes');
            //$table->foreign('option_id')->references('id')->on('votes_options');
            //$table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_users');
    }
};
