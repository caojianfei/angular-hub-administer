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

            $table->tinyInteger('write_type')
                ->comment('创作类型：0-原创，1-转载，2-翻译')
                ->default(0);

            $table->string('title')
                ->comment('文章标题')
                ->index();

            $table->text('content')
                ->comment('文章内容')
                ->nullable();

            $table->integer('category_id', false, true)
                ->comment('分类id')
                ->index();

            $table->integer('replay_count', false, true)
                ->comment('回复数量')
                ->default(0)
                ->index();

            $table->integer('view_count', false, true)
                ->comment('阅读次数')
                ->default(0)
                ->index();

            $table->integer('like_count', false, true)
                ->comment('点赞数量')
                ->default(0)
                ->index();

            $table->integer('order')
                ->comment('排序')
                ->default(0);

            $table->text('excerpt')
                ->comment('摘要');

            $table->string('slug')
                ->comment('文章名称标识，seo使用')
                ->nullable();

            $table->integer('answer_id')
                ->comment('问题的回答，对应replay表的回复，问答类目下的文章专属')
                ->default(0);

            $table->string('share_link')
                ->comment('分享的链接，分享类目下的文章专属')
                ->nullable();

            $table->tinyInteger('status')
                ->comment('文章状态：0-草稿；1-正式发布')
                ->default(1);

            $table->dateTime('last_replay_time')
                ->comment('最新回复时间')
                ->nullable();

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
