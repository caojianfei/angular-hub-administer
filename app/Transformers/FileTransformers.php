<?php

namespace App\Transformers;

use App\Models\File;
use League\Fractal\TransformerAbstract;

class FileTransformers extends TransformerAbstract
{
    public function transform($file)
    {
        if ($file instanceof File) {
            return [
                'id' => $file->id,
                'url' => asset($file->save_path)
            ];
        }
        return [];
    }

}