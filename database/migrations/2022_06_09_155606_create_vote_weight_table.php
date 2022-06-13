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
        Schema::create('vote_weight', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('vote_id');
            $table->unsignedBigInteger('position_level_id');//职位id
            $table->Float('weight');//权重
            $table->timestamps();

            //$table->foreign('vote_id')->references('id')->on('vote');
            //$table->foreign('position_level_id')->references('id')->on('user_position_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_weight');
    }
};
