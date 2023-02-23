<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Company;

class CompanyUpdateRequest extends FormRequest
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
            'company_name' => ['required','string', 'max:255'],
            'company_email' => ['nullable','email', 'max:255', Rule::unique(Company::class,'email')->ignore($this->id)],
            'company_web' => ['url','nullable'],
            'company_logo' => ['image','nullable']
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
            'company_name' => 'Name',
            'company_email' => 'Email',
            'company_web' => 'Website',
            'company_logo' => 'Logo',
        ];
    }
}
