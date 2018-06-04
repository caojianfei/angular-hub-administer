<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;


class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->route()->getName()) {
            case 'image':
                {
                    return [
                        'file' => 'image|max:5242880'
                    ];
                }
            default:
                {
                    return [];
                }
        }
    }
}
