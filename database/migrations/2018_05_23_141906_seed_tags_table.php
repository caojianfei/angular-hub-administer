<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = now()->toDateTimeString();

        $data = [
            [
                'category_id' => 1,
                'tags' => [
                    ['name' => 'php'],
                    ['name' => 'javascript'],
                    ['name' => 'java'],
                    ['name' => 'python'],
                    ['name' => 'go'],
                    ['name' => 'node.js'],
                    ['name' => 'css'],
                    ['name' => 'html']
                ]
            ],
            [
                'category_id' => 2,
                'tags' => [
                    ['name' => 'laravel'],
                    ['name' => 'thinkphp'],
                    ['name' => 'spring']
                ]
            ],
            [
                'category_id' => 3,
                'tags' => [
                    ['name' => 'linux'],
                    ['name' => 'apache'],
                    ['name' => 'nginx']
                ]
            ],
            [
                'category_id' => 4,
                'tags' => [
                    ['name' => 'mysql'],
                    ['name' => 'redis'],
                    ['name' => 'mongodb']
                ]
            ],
            [
                'category_id' => 5,
                'tags' => [
                    ['name' => 'git'],
                    ['name' => 'sublime-text'],
                    ['name' => 'intellij-idea'],
                ]
            ],
            [
                'category_id' => 6,
                'tags' => [
                    ['name' => 'android'],
                    ['name' => 'ios'],
                    ['name' => 'chrome'],
                ]
            ],
            [
                'category_id' => 7,
                'tags' => [
                    ['name' => 'html5'],
                    ['name' => 'react.js'],
                    ['name' => '搜索引擎'],
                ]
            ]
        ];

        $inserts = [];

        foreach ($data as $item) {
            $category_id = $item['category_id'];
            $tags = $item['tags'];

            foreach ($tags as $tag) {
                $inserts[] = array_merge(['category_id' => $category_id], $tag, ['created_at' => $now, 'updated_at' => $now]);
            }
        }

        DB::table('tags')->insert($inserts);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tags')->truncate();
    }
}
