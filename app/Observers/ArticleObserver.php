<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    public function saving(Article $article)
    {
        //$article->content = clean($article->content, 'user_article_body');
        $article->excerpt = make_excerpt($article->content);
    }
}