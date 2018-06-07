<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Replay
 *
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property int $replay_id
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay whereReplayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay whereUserId($value)
 * @mixin \Eloquent
 */
class Replay extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replayComment()
    {
        return $this->belongsTo(Replay::class, 'replay_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
