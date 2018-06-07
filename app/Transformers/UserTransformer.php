<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;


class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['avatar'];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'emial' => $user->email,
            'avatar_id' => $user->avatar_id,
            'information' => $user->information,
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString()
        ];
    }


    public function includeAvatar(User $user)
    {
        return $this->item($user->avatar, new FileTransformers());
    }

}