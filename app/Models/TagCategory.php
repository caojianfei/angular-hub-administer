<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TagCategory
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TagCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TagCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TagCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TagCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TagCategory extends Model
{
    //
}
