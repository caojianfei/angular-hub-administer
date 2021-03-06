<?php

namespace App\Http\Requests\Api;


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
        switch ($this->method()) {
            case 'POST':
                {
                    $category_id = $this->category_id;

                    $rule = [
                        'title' => 'required|string',
                        'tags' => 'required|array',
                        'category_id' => [
                            'required',
                            'integer',
                            'exists:categories,id'
                        ],
                        'status' => 'required|numeric|in:0,1'
                    ];

                    if ($category_id && $category_id !== 3) {
                        $rule['content'] = 'required|string';
                    }

                    return $rule;
                }
            case 'PATCH':
                {
                    return [
                        'title' => 'string',
                        'content' => 'string|nullable',
                        'tags' => 'array',
                        'category_id' => [
                            'integer',
                            'exists:categories,id'
                        ]
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
            'title' => '文章标题',
            'content' => '文章内容',
            'tags' => '文章标签',
            'category_id' => '文章分类'
        ];
    }
}
