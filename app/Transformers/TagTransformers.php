<?php

namespace App\Transformers;

use App\Models\Tag;
use League\Fractal\TransformerAbstract;


class TagTransformers extends TransformerAbstract
{

    public function transform(Tag $tag)
    {
        return [
            'id' => $tag->id,
            'category_id' => $tag->category_id,
            'name' => $tag->name,
            'icon' => $tag->icon,
            'description' => $tag->description,
            'created_at' => $tag->created_at->toDateTimeString(),
            'updated_at' => $tag->updated_at->toDateTimeString(),
        ];
    }


}