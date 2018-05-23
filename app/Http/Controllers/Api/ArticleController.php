<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ArticleRequest;

class ArticleController extends BaseController
{
    function __construct()
    {
        $this->middleware('api.auth')->except([ 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $article->user_id = auth()->id();
        $article->save();

        return $this->response->item($article, new ArticleTransformer())->setStatusCode(201);
    }


    public function show(Article $article)
    {
        return $this->response->item($article, new ArticleTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'destroy';
    }
}
