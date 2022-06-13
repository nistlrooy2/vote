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
        Schema::dropIfExists('votes');
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->string('title',128)->unique();//投票标题
            $table->text('description');//描述
            $table->boolean('is_anonymous');//是否是匿名投票
            $table->unsignedBigInteger('partment_id');//所在部门
            //$table->unsignedBigInteger('position_level_id');//所处职位等级
            $table->timestamps();

            $table->foreign('partment_id')->references('id')->on('user_partment');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
};
