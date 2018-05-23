<?php

namespace App\Http\Requests\Api;

use App\Rules\ConfirmCategory;
use Dingo\Api\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        switch ($this->method) {
            case 'POST':
                {
                    return[
                        'title' => 'required|string',
                        'content' => 'required|string',
                        'category_id' => [
                            'required',
                            'integer',
                            new ConfirmCategory()
                        ]
                    ];
                }
            case 'PUT':
                {
                    return [
                        'title' => 'filled|string',
                        'content' => 'filled|string',
                        'category_id' => [
                            'filled',
                            'integer',
                            new ConfirmCategory()
                        ]
                    ];
                }
            default:
                {
                    return [];
                }
        }
    }
}
