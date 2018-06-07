<?php

namespace App\Http\Requests\Api;


class UserRequest extends FormRequest
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
                {
                    return [
                        'name' => 'required|string|max:255|unique:users',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6|confirmed',
                        'captch' => 'required|string',
                        'captch_key' => 'required|string'
                    ];
                }
            case 'PATCH':
                {
                    $user_id = auth('api')->id();

                    return [
                        'name' => "string|max:255|unique:users,name,$user_id",
                        'password' => 'string|min:6|confirmed',
                        'information' => 'array',
                        'avatar_id' => 'exists:files,id'
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
            'name' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
            'captch' => '验证码',
            'information' => '个人资料',
            'avatar_id' => '头像'
        ];
    }
}
