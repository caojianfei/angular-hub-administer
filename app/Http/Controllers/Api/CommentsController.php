<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Http\Requests\Api\CommentRequest;
use App\Models\Replay;
use App\Transformers\ReplayTransformers;

class CommentsController extends BaseController
{
    function __construct()
    {
        $this->middleware('api.auth')->except('index');
    }

    public function index(Article $article)
    {
        return 'index';
    }

    /**
     * 写回复
     *
     * @param Article $article
     * @param CommentRequest $request
     * @param Replay $replay
     * @return \Dingo\Api\Http\Response
     */
    public function store(Article $article, CommentRequest $request, Replay $replay)
    {
        $replay->user_id = auth('api')->id();
        $replay->article_id = $article->id;
        $replay->content = $request->input('content');

        if ($replay_id = $request->input('replay_id')) {
            $replay->replay_id = $replay_id;
        }

        $replay->save();

        return $this->response->item($replay, new ReplayTransformers())->setStatusCode(201);
    }

    /**
     * 查看回复
     *
     * @param Replay $replay
     * @return \Dingo\Api\Http\Response
     */
    public function show(Replay $replay)
    {
        return $this->response->item($replay, new ReplayTransformers());
    }

    /**
     * 修改回复
     *
     * @param Replay $replay
     * @param CommentRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Replay $replay, CommentRequest $request)
    {
        $replay->content = $request->input('content');
        $replay->save();

        return $this->response->item($replay, new ReplayTransformers());
    }

    /**
     * 删除回复
     *
     * @param Replay $replay
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function destroy(Replay $replay)
    {
        $replay->delete();

        return $this->response->noContent();
    }
}
