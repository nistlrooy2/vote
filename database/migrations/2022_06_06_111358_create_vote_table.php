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
        Schema::create('vote', function (Blueprint $table) {
            $table->id();
            $table->string('title',128);
            $table->text('description');//描述
            $table->unsignedBigInteger('vote_list_id');
            $table->unsignedTinyInteger('selectable_number')->default(1);//可选个数
            $table->timestamps();

            //$table->foreign('vote_list_id')->references('id')->on('vote_list');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote');
    }
};
