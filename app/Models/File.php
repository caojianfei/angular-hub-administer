<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id', 'size', 'mine_type', 'original_name', 'original_extension', 'save_path'
    ];
}
