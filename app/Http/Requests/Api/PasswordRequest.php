<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class PasswordRequest extends FormRequest
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
