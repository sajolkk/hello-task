<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => ['required','max:255'],
                    'email' => ['nullable','email','unique:companies','max:255'],
                    'logo' => ['mimes:jpeg,png,jpg'] 
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => ['required','max:255'],
                    'email' => ['nullable','email','max:255',Rule::unique('companies','email')->ignore($this->route('company'))],
                    // 'logo' => ['nullable','mimes:jpeg,png,jpg'] 
                ];
            default:
                # code...
                break;
        }
    }
}
