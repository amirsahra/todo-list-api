<?php

namespace App\Http\Requests\V1\Auth;

use App\Http\Requests\V1\CustomFormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends CustomFormRequest
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


    private function checkEmailAndPasswordMatch(): bool
    {
        return auth()->attempt([
            'email' => $this->input('email'),
            'password' => $this->input('password')
        ]);
    }
}
