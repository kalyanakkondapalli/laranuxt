<?php

namespace App\Http\Requests\profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'                  => 'required|max:150',
            'email'                 => "required|email|max:150",
            'contact'               => "required|numeric",
            'years_of_experience'   => "required|numeric",
            'qualification'         => "required|max:150",
        ];
    }
}
