<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 投票活动列表
 * 一个投票活动可能包括多个投票
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
        Schema::dropIfExists('vote_lists');
        Schema::create('vote_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title',128)->unique();//投票标题
            $table->text('description');//描述
            $table->boolean('is_anonymous');//是否是匿名投票
            $table->unsignedBigInteger('partment_id');//所在部门
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            //$table->unsignedBigInteger('position_levels_id');//所处职位等级
            $table->timestamps();

            //$table->foreign('partment_id')->references('id')->on('users_partments');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_lists');
    }
};
