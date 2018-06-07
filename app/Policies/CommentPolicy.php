<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Replay;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the replay.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Replay  $replay
     * @return mixed
     */
    public function view(User $user, Replay $replay)
    {
        return true;
    }

    /**
     * Determine whether the user can create replays.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the replay.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Replay  $replay
     * @return mixed
     */
    public function update(User $user, Replay $replay)
    {
        return $user->id === $replay->user_id;
    }

    /**
     * Determine whether the user can delete the replay.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Replay  $replay
     * @return mixed
     */
    public function delete(User $user, Replay $replay)
    {
        return $user->id === $replay->user_id;
    }
}
