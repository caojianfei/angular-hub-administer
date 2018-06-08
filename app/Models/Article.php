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
 * @property int $write_type 创作类型：0-原创，1-转载，2-翻译
 * @property string|null $last_replay_time 最新回复时间
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Replay[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $likedUsers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereLastReplayTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereWriteType($value)
 */
class Article extends Model
{
    public $fillable = [
        'title', 'content', 'category_id', 'excerpt', 'slug', 'write_type'
    ];

    /**
     * 作者
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 文章标签
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * 文章类目
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 点赞用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'user_like_article');
    }

    /**
     * 文章评论
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Replay::class);
    }

    /**
     * 问题的答案
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function answer()
    {
        return $this->hasOne(Replay::class, 'id', 'answer_id');
    }

    /**
     * 热门文章
     *
     * @param Builder $query
     * @return Builder
     */
    public function hot(Builder $query) {

        return $query->orderBy('replay_count', 'desc')
            ->orderBy('like_count', 'desc')
            ->orderBy('view_count', 'desc');
    }

}
