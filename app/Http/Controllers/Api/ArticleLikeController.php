<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;

class ArticleLikeController extends BaseController
{
    function __construct()
    {
        $this->middleware('api.auth');
    }

    public function store(Article $article)
    {

        $user_id = auth('api')->id();

        if ($article->likedUsers()->where('user_id', $user_id)->first()) {
            return $this->response->error('已经点过赞啦', 422);
        }

        $article->likedUsers()->attach($user_id);

        return $this->response->noContent();
    }
}
