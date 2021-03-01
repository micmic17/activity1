<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
    {
        return [
            'name' => 'required|unique:companies,name',
            'email' => 'unique:companies,email',
            'image' => 'dimensions:min_width=100, min_height=100',
        ];

    }

    public function messages()
    {
        return [
            'name.unqie' => 'Name already taken by a different company',
            'email.unique' => 'Some company already took this email',
            'image.dimensions' => 'Min dimension is 100x100!',
        ];
    }
}