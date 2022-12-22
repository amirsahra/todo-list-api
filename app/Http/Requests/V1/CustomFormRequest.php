<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->apiResult(__('messages.validate_error'),
            ['errors' => $validator->errors()],
            false,
            422
        ));
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->apiResult(__('messages.validate_authorized'),
            ['authorization' => __('messages.unauthorized')],
            false,
            403
        ));
    }
}
