<?php

namespace App\Observers;


use App\Models\Replay;

class ReplayObservers
{
    public function created(Replay $replay) {
        $replay->article->increment('replay_count');
    }

    public function deleted(Replay $replay) {
        $article = $replay->article;

        if ($article->replay_count <= 0) {
            return ;
        }

        $replay->article->decrement('replay_count');
    }
}