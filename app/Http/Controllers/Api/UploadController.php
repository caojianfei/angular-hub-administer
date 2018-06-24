<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController extends BaseController
{
    /**
     * 上传图片
     *
     * @param Request $request
     * @return mixed
     * @throws \ErrorException
     */
    public function image(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'file' => 'required|image|max:5242880'
        ]);

        if ($validator->fails()) {
            $error_msg = $validator->errors()->getMessages()['file'][0];
            return $this->response->array([
                "success" => false,
                "msg" => $error_msg,
                "file_path" => ''
            ]);
        }

        $result = $this->save($request->file('file'), 'images');

        return $this->response->array([
            "success" => true,
            "msg" => "upload success",
            "file_path" => $result['url'],
            "file_id" => $result['id']
        ]);

    }

    public function editormdImageUpload(Request $request)
    {
        $callback_url = $request->callback;
        $dialog_id = $request->dialog_id;
        $temp = date('ymdhis');

        $validator = \Validator::make($request->all(), [
            'editormd-image-file' => 'required|image|max:5242880'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->getMessages()['editormd-image-file'][0];
            $success = 0;
        } else {
            $result = $this->save($request->file('editormd-image-file'), 'images');
            $url = $result['url'];
            $success = 1;
            $message = '上传成功';
        }

        $redirect_url = $callback_url . '?' . http_build_query([
                'dialog_id' => $dialog_id,
                'temp' => $temp,
                'success' => $success,
                'message' => $message,
                'url' => $url ?? null
            ]);
        return redirect($redirect_url);
    }

    /**
     * 图片保存及数据入库
     *
     * @param UploadedFile $file
     * @param $type
     * @param null $file_name
     * @return array
     */
    protected function save(UploadedFile $file, $type, $file_name = null)
    {
        $floder = "uploads/$type/" . date('Ym/d', time());

        $path = public_path($floder);

        $extension = strtolower($file->getClientOriginalExtension());

        $file_name = $file_name ?? time() . '_' . str_random(12) . '.' . $extension;

        $file->move($path, $file_name);

        $model = \App\Models\File::create([
            'user_id' => auth('api')->id() ?? 0,
            'size' => $file->getSize(),
            'mine_type' => $file->getClientMimeType(),
            'original_name' => $file->getClientOriginalName(),
            'original_extension' => $file->getClientOriginalExtension(),
            'save_path' => $floder . '/' . $file_name
        ]);


        return [
            'full_path' => $floder . '/' . $file_name,
            'url' => asset("$floder/$file_name"),
            'file' => $model,
            'id' => $model->id
        ];
    }


}
