<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Employee;

class EmployeeAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'em_first_name' => ['required','string', 'max:255'],
            'em_last_name' => ['required','string', 'max:255'],
            'em_email' => ['nullable','email', 'max:255', Rule::unique(Employee::class,'email')],
            'em_company' => ['required']
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
            'em_first_name' => 'First Name',
            'em_last_name' => 'Last Name',
            'em_email' => 'Email',
            'em_company' => 'Company',
        ];
    }
}
