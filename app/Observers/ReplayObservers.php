<?php

namespace App\Observers;


use App\Models\Article;
use App\Models\Replay;

class ReplayObservers
{
    public function created(Replay $replay) {
        $replay->article->increment('replay_count');
    }

    public function deleted(Replay $replay) {
        $article = $replay->article;

        if ($article->replay_count > 0) {
            $replay->article->decrement('replay_count');
        }

        if ($article = Article::where('answer_id', $replay->id)->first()) {
            $article->answer_id = 0;
            $article->save();
        }
    }
}