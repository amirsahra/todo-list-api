<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;

class UserRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth('api')->id() == $this->user->id)
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
        return [
            'first_name' => ['min:3', 'max:225'],
            'last_name' => ['min:3', 'max:225'],
            'birthday' => ['date'],
            'gender' => [Rule::in(['female', 'male'])],
            'phone' => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', Rule::unique('users')],
            'avatar' => [Rule::imageFile()], //'mimes:jpeg,jpg,png,gif|max:20000'
            'password' => ['min:6']
        ];
    }
}
