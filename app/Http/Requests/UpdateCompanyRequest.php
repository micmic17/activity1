<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'logo' => 'mimes:jpeg, bmp, png|dimensions:min_width=100, min_height=100',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Name already taken by a different company',
            'email.unique' => 'Some company already took this email',
            'logo.dimensions' => 'Min dimension is 100x100!',
        ];
    }
}