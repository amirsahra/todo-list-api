<?php

namespace App\Http\Requests\V1\Auth;

use App\Http\Requests\V1\CustomFormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends CustomFormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'min:3', 'max:225'],
            'last_name' => ['required', 'min:3', 'max:225'],
            'gender' => ['required', Rule::in(['female', 'male'])],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10',Rule::unique('users')],
            'email' => ['required', 'email', Rule::unique('users')],
            'avatar' => [Rule::imageFile()], //'mimes:jpeg,jpg,png,gif|max:20000'
            'birthday' => ['date'],
            'password' => ['required', 'min:6']
        ];
    }

}
