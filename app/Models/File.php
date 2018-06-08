<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $size
 * @property string $mine_type
 * @property string $original_name
 * @property string $original_extension
 * @property string $save_path
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMineType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereOriginalExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSavePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUserId($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $fillable = [
        'user_id', 'size', 'mine_type', 'original_name', 'original_extension', 'save_path'
    ];
}
