<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property int $category_id
 * @property int $replay_count
 * @property int $view_count
 * @property int $like_count
 * @property int $order
 * @property string $excerpt
 * @property string $slug
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereLikeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereReplayCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereViewCount($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    public $fillable = [
        'title', 'content', 'category_id', 'excerpt', 'slug', 'write_type'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Api\User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hot(Builder $query) {

       return $query->orderBy('replay_count', 'desc')
                    ->orderBy('like_count', 'desc')
                    ->orderBy('view_count', 'desc');
    }

}
