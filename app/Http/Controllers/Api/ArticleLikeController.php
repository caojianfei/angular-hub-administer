<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;

class ArticleLikeController extends BaseController
{
    function __construct()
    {
        $this->middleware('api.auth');
    }

    /**
     * 点赞
     *
     * @param Article $article
     * @return \Dingo\Api\Http\Response|void
     */
    public function store(Article $article)
    {
        $user_id = auth('api')->id();

        if ($article->likedUsers()->where('user_id', $user_id)->first()) {
            return $this->response->error('已经点过赞啦！', 403);
        }

        $article->likedUsers()->attach($user_id);

        $article->increment('like_count');

        return $this->response->noContent();
    }

    /**
     * 取消点赞
     *
     * @param Article $article
     * @return \Dingo\Api\Http\Response|void
     */
    public function delete(Article $article)
    {
        $user_id = auth('api')->id();

        if (!$article->likedUsers()->where('user_id', $user_id)->first()) {
            return $this->response->error('还没有点过赞哦！', 403);
        }

        $article->likedUsers()->detach($user_id);

        if ($article->like_count > 0) {
            $article->decrement('like_count');
        }
        return $this->response->noContent();
    }

    /**
     * 确认当前用户是否点过赞
     *
     * @param Article $article
     * @return mixed
     * @throws \ErrorException
     */
    public function islike(Article $article) {
        $user_id = auth('api')->id();

        $is_like = $article->likedUsers()->where('user_id', $user_id)->first() ?
            true : false;

        return $this->response->array([
            'liked' => $is_like
        ]);
    }
}
