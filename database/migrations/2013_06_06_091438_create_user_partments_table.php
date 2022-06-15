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
        //Schema::dropIfExists('user_partments');
        Schema::create('user_partments', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);//部门名
            $table->unsignedBigInteger('parent_id');//上一级部门id
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
        Schema::dropIfExists('user_partments');
    }
};
