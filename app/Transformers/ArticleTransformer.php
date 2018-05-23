<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'user_id' => $article->id,
            'title' => $article->title,
            'category_id' => $article->category_id,
        ];
    }

}