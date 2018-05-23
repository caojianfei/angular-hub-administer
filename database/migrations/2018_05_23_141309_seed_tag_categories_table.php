<?php

use Illuminate\Database\Migrations\Migration;

class SeedTagCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = now()->toDateTimeString();

        $tag_categories = [
            ['name' => '开发语言', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '平台框架', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '服务器', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '数据库和缓存', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '开发工具', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '系统设备', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '其他', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('tag_categories')->insert($tag_categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tag_categories')->truncate();
    }
}
