<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'email' => ['required', Rule::exists('users')],
            'password' => ['required'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->failed()) return;

            $attemptResult = $this->checkEmailAndPasswordMatch();

            if (!$attemptResult) {
                $validator->errors()
                    ->add('email', 'Email does not match password.');
            }
        });
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->apiResult(__('messages.validate_error'),
            ['errors' => $validator->errors()],
            false,
            422
        ));
    }

    private function checkEmailAndPasswordMatch(): bool
    {
        return auth()->attempt([
            'email' => $this->input('email'),
            'password' => $this->input('password')
        ]);
    }
}
