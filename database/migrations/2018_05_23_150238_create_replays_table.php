<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->index();
            $table->integer('article_id', false, true)->index();
            $table->integer('replay_id', false, true)->default(0)->index();
            $table->text('content');
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
        Schema::dropIfExists('replays');
    }
}
