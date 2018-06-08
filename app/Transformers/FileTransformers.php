<?php

namespace App\Transformers;

use App\Models\File;
use League\Fractal\TransformerAbstract;

class FileTransformers extends TransformerAbstract
{
    public function transform(File $file)
    {
        return [
            'id' => $file->id,
            'url' => asset($file->save_path)
        ];
    }

}