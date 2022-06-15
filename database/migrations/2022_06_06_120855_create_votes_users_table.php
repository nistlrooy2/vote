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
        Schema::create('votes_users', function (Blueprint $table) {
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
        Schema::dropIfExists('votes_users');
    }
};
