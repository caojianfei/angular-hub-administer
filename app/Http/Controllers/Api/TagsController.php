<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Transformers\TagTransformers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends BaseController
{
    public function index(Request $request, Tag $tag)
    {
        $query = $tag->query();

        if ($name = $request->input('name')) {
            $query->where('name', 'like', "$name%");
        }

        return $this->response->collection($query->get(), new TagTransformers());
    }
}
