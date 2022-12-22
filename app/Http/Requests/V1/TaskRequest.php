<?php

namespace App\Http\Requests\V1;

use App\Rules\ExistsCategoryForUser;

class TaskRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->method == 'POST')
            return true;

        if (auth('api')->id() == $this->task->user_id)
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
                'category_id' => ['required', new ExistsCategoryForUser()],
                'execution_time' => ['required', 'date', 'after:' . config('todosettings.time_permit.min')],
            ];
        }

        return [
            'name' => ['max:225', 'min:4'],
            'category_id' => [new ExistsCategoryForUser()],
            'execution_time' => ['date', 'after:' . config('todosettings.time_permit.min')],
        ];

    }

}
