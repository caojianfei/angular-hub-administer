<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'tags'];

    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'user_id' => $article->id,
            'title' => $article->title,
            'content' => $article->content,
            'category_id' => $article->category_id,
        ];
    }

    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTransformer());
    }


    public function includeTags(Article $article)
    {
        return $this->collection($article->tags, new TagTransformers());
    }
}