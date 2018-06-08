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
            $table->tinyInteger('write_type')->comment('创作类型：0-原创，1-转载，2-翻译')->default(0);
            $table->string('title')->index()->comment('文章标题');
            $table->text('content')->comment('文章内容');
            $table->integer('category_id', false, true)->index()->comment('分类id');
            $table->integer('replay_count', false, true)->index()->default(0)->comment('回复数量');
            $table->integer('view_count', false, true)->index()->default(0)->comment('阅读次数');
            $table->integer('like_count', false, true)->index()->default(0)->comment('点赞数量');
            $table->integer('order')->default(0)->comment('排序');
            $table->text('excerpt')->comment('摘要');
            $table->string('slug')->nullable()->comment('文章名称标识，seo使用');
            $table->integer('answer_id')->comment('问题的回答，对应replay表的回复')->default(0);
            $table->tinyInteger('status')->comment('文章状态：0-草稿；1-正式发布');
            $table->dateTime('last_replay_time')->comment('最新回复时间')->nullable();
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
