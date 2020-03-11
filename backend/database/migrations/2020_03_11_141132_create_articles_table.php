<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自增主键');
            $table->string('title')->comment('标题');
            $table->text('body')->comment('内容');
            $table->timestamps();
            $table->tinyInteger('status')->comment('状态');
            $table->unsignedBigInteger('user_id')->comment('外键，来自用户表');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
