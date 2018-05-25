<?php

namespace App\Http\Requests\Api;


class PasswordRequest extends FormRequest
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
                        'email' => 'required|email'
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'token' => 'required|string',
                        'email' => 'required|email',
                        'password' => 'required|confirmed|min:6',
                    ];
                }
            default:
                {
                    return [];
                }
        }
    }
}
