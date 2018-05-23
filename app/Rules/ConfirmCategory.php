<?php

namespace App\Rules;

use Cache;
use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class ConfirmCategory implements Rule
{

    protected $categories;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Cache::rememberForever('categories', function() {
            return \DB::table('categories')->get()->toArray();
        });
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, $this->categories);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '不存在的文章类目';
    }
}
