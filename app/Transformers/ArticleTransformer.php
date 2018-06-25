<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'tags', 'category', 'comments', 'answer'];

    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'user_id' => $article->id,
            'write_type' => $article->write_type,
            'title' => $article->title,
            'content' => $article->content,
            'category_id' => $article->category_id,
            'replay_count' => ($article->replay_count > 999) ? '999+' : $article->replay_count,
            'view_count' => ($article->view_count > 999) ? '999+' : $article->view_count,
            'like_count' => ($article->like_count > 999) ? '999+' : $article->like_count,
            'order' => $article->order,
            'excerpt' => $article->excerpt,
            'slug' => $article->slug,
            'last_replay_time' => $article->last_replay_time,
            'answer_id' => $article->answer_id,
            'share_link' => $article->share_link,
            'status' => $article->status,
            'created_at' => $article->created_at->diffForHumans(),
            'updated_at' => $article->updated_at->diffForHumans(),
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

    public function includeCategory(Article $article)
    {
        return $this->item($article->category, new CategoryTransformer());
    }

    public function includeComments(Article $article)
    {
        return $this->collection($article->comments, new ReplayTransformers());
    }

    public function includeAnswer(Article $article)
    {
        if (! $article->answer) {
            return $this->null();
        }

        return $this->item($article->answer, new ReplayTransformers());
    }

}