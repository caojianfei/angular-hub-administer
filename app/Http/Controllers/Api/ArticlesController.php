<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Transformers\ArticleTransformer;
use App\Http\Requests\Api\ArticleRequest;

class ArticlesController extends BaseController
{
    function __construct()
    {
        $this->middleware('api.auth')->except([ 'index', 'show']);
    }

    /**
     * 获取文章列表
     *
     * @param Article $article
     * @return \Dingo\Api\Http\Response
     */
    public function index(Article $article)
    {
        $query = $article->query();
        // 分类
        if ($category_id = \request('category_id')) {
            $query->where('category_id', $category_id);
        }

        // 热门
        if (request('hot')) {
            $query = $article->hot($query);
        }

        // 倒序
        if (request('recent')) {
            $query->latest();
        }

        // 最新回复
        if (request('recent_replay')) {
            $query->latest('last_replay_time');
        }

        $articles = $query->paginate(\request('per_page', 20));

        return $this->response->paginator($articles, new ArticleTransformer());
    }


    /**
     * 新增文章
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return \Dingo\Api\Http\Response
     */
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = auth('api')->id();
        $article->save();

        $article->tags()->sync($request->tags);

        return $this->response->item($article, new ArticleTransformer())->setStatusCode(201);
    }


    /**
     * 查看文章
     *
     * @param Article $article
     * @return \Dingo\Api\Http\Response
     */
    public function show(Article $article)
    {
        return $this->response->item($article, new ArticleTransformer());
    }

    /**
     * 文章更新
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return \Dingo\Api\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->only(['title', 'content', 'category_id']));

        if ($request->tags) {
            $article->tags()->sync($request->tags);
        }

        return $this->response->item($article, new ArticleTransformer());
    }

    /**
     * 文章删除
     *
     * @param Article $article
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function destroy(ArticleRequest $request, Article $article)
    {
        $article->delete();

        return $this->response->noContent();
    }
}
