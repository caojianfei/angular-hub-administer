<?php

namespace App\Transformers;

use App\Models\Replay;
use League\Fractal\TransformerAbstract;

class ReplayTransformers extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'replayComment', 'article'];

    public function transform(Replay $replay)
    {
        return [
            'id' => $replay->id,
            'user_id' => $replay->user_id,
            'article_id' => $replay->article_id,
            'content' => $replay->content,
            'created_at' => $replay->created_at->diffForHumans(),
            'updated_at' => $replay->updated_at->diffForHumans()
        ];
    }

    public function includeUser(Replay $replay)
    {
        return $this->item($replay->user, new UserTransformer());
    }

    public function includeReplayComment(Replay $replay)
    {
        return $this->item($replay->replayComment, new ReplayTransformers());
    }

    public function includeArticle(Replay $replay)
    {
        return $this->item($replay->article, new ArticleTransformer());
    }
}