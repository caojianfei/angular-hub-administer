<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id', false, true);
            $table->string('title')->index();
            $table->text('content');
            $table->integer('category_id', false, true)->index();
            $table->integer('replay_count', false, true)->index()->default(0);
            $table->integer('view_count', false, true)->index()->default(0);
            $table->integer('like_count', false, true)->index()->default(0);
            $table->integer('order')->default(0);
            $table->text('excerpt');
            $table->string('slug');
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
        Schema::dropIfExists('articles');
    }
}
