<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadController extends BaseController
{
    public function image(UploadRequest $request)
    {


//        $file = $request->file('image');
//        dump($file);
//        dump(asset("storage/$file"));
//        dump(Storage::url($file));
//        dump("getSize: " . $file->getSize());
//        dump("getClientMimeType: " . $file->getClientMimeType());
//        dump("getClientOriginalName: " . $file->getClientOriginalName());
//        dump("getClientOriginalExtension: " . $file->getClientOriginalExtension());
//        dump("getExtension: " . $file->getExtension());

    }


    protected function save(UploadedFile $file)
    {

    }


}
