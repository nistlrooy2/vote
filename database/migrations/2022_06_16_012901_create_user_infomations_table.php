<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 用户信息表
 * 用来存储用户部门职位等信息
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
        Schema::create('user_infomations', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->boolean('is_anonymous')->default(false);//是否匿名
            $table->unsignedBigInteger('partment_id');//部门id
            $table->unsignedBigInteger('position_level_id');//职位id
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
        Schema::dropIfExists('user_infomations');
    }
};
