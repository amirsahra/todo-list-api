<?php

namespace App\Http\Requests\V1\Auth;

use App\Http\Requests\V1\CustomFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PasswordResetRequest extends CustomFormRequest
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
            'token' => ['required'],
            'email' => ['required', 'email', Rule::exists('users')],
            'password' => ['required', 'confirmed', 'min:6'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->failed()) return;

            if (!$this->checkEmailAndTokenMatch()) {
                $validator->errors()
                    ->add('email', 'Email does not match token.');
            }
        });
    }


    private function checkEmailAndTokenMatch(): bool
    {
         return DB::table('password_resets')
            ->where('email', '=', $this->input('email'))
            ->where('token', '=', $this->input('token'))
            ->exists();
    }

}
