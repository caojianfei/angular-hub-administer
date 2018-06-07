<?php

namespace App\Http\Requests\Api;


class CommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            case 'PATCH':
                {
                    return [
                        'content' => 'required|string'
                    ];
                }
            default:
                {
                    return [];
                }
        }
    }

    public function attributes()
    {
        return [
            'content' => '回复内容'
        ];
    }
}
