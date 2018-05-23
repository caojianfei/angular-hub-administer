<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = now()->toDateTimeString();

        $categories = [
            [
                'name' => '文章',
                'description' => '个人博客、总结等',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => '问答',
                'description' => '各种疑难杂症',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => '分享',
                'description' => '各种分享内容，需要附上链接和描述',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        \App\Models\Category::insert(
            $categories
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Category::truncate();
    }
}
