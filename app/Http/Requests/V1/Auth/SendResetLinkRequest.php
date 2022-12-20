<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SendResetLinkRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::exists('users')]
        ];
    }

    /*public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->failed()) return;

            if (auth('api')->user()->email != $this->input('email')) {
                $validator->errors()
                    ->add('email', 'The email sent is for another user and you cannot have this request.');
            }
        });
    }*/

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->apiResult(__('messages.validate_error'),
            ['errors' => $validator->errors()],
            false,
            422
        ));
    }
}
