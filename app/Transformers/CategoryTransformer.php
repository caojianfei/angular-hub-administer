<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/6/006
 * Time: 18:01
 */

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;


class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'article_num' => $category->article_num,
            'created_at' => $category->created_at->toDateTimeString(),
            'updated_at' => $category->updated_at->toDateTimeString(),
        ];
    }

}