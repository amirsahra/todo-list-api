<?php

namespace App\Http\Requests\V1;

use App\Rules\ExistsCategoryForUser;
use Illuminate\Validation\Rule;

class CategoryRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->method() == 'POST')
            return true;

        if (auth('api')->id() == $this->category->user_id)
            return true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method == 'POST') {
            return [
                'name' => ['required', 'max:225', 'min:4'],
                'parent_id' => ['required', Rule::exists('categories')],
            ];
        }

        return [
            'name' => ['max:225', 'min:4'],
            'category_id' => [new ExistsCategoryForUser()],
        ];
    }
}
