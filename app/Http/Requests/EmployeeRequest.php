<?php

namespace App\Http\Requests;

use App\Rules\CheckMobileNumber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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

    // /^(?:\+88|88)?(01[3-9]\d{8})$/
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'first_name' => ['required','max:255'],
                    'last_name' => ['required','max:255'],
                    'company_id' => ['required','exists:companies,id'],
                    'email' => ['nullable', 'string', 'email', 'max:255', 'unique:employees'],
                    'phone' => ['nullable',new CheckMobileNumber()],
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'first_name' => ['required','max:255'],
                    'last_name' => ['required','max:255'],
                    'company_id' => ['required','exists:companies,id'],
                    'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('companies','email')->ignore($this->route('employee'))],
                    'phone' => ['nullable',new CheckMobileNumber()],
                ];
            default:
                # code...
                break;
        }
    }
}
