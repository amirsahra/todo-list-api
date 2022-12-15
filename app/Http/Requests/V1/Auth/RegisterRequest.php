<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'email' => ['required', 'email', Rule::unique('users')],
            'avatar' => [Rule::imageFile()], //'mimes:jpeg,jpg,png,gif|max:20000'
            'password' => ['required', 'min:6']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->apiResult(__('messages.validate_error'),
            ['errors' => $validator->errors()],
            false,
            403
        ));
    }
}
