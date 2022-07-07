<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'user_id'            => 'required|exists:users,id',
            'company_name'       => 'required|max:150',
            'role'               => 'required|max:150',
            'is_current_working' => 'boolean',
            'job_nature'         => 'required|max:1000',
            'start_date'         => 'required|date_format:Y-m-d',
            'end_date'           => 'nullable|date_format:Y-m-d|after:start_date',
        ];
    }
}
