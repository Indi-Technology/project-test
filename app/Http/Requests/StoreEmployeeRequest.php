<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'phone'      => ['required', 'string', 'max:15'],
            'logo'       => ['nullable', 'image', 'max:2048'],
        ];
    }

    /**
     * Get the custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => ':attributes is required.',
            'exists'   => ':attributes must exist in the database.',
            'string'   => ':attributes must be a string.',
            'image'    => ':attributes must be a valid image file.',
            'max.image' => ':attributes may not be greater than 2MB.',
            'max.string' => ':attributes may not be greater than 15 characters.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'company_id' => 'Company ID',
            'phone'      => 'Phone Number',
            'logo'       => 'Employee Logo',
        ];
    }
}
