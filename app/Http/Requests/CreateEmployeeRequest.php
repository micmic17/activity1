<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {;
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                Rule::unique('employees', 'email')->where(function ($query) {
                    return $query->where('company_id', request()->company_id);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Someone from the company already took this email',
        ];
    }
}