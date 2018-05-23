<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ArticleRequest;

class ArticleController extends BaseController
{
    function __construct()
    {
        $this->middleware('jwt.auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {}


    /**
     * 新增文章
     *
     * @param ArticleRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(ArticleRequest $request, Article $article)
    {

        $article->fill($request->all());
        $article->user_id = auth()->id();
        $article->save();

        return $this->response->created(null, $article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 'update';
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
