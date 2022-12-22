<?php

namespace App\Http\Requests\V1;

use App\Rules\ExistsCategoryForUser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'name' => ['required', 'max:225', 'min:4'],
            'category_id' => ['required',new ExistsCategoryForUser()],
            'execution_time' => ['required', 'date', 'after:'. config('todosettings.time_permit.min')],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->apiResult(__('messages.validate_error'),
            ['errors' => $validator->errors()],
            false,
            422
        ));
    }
}
