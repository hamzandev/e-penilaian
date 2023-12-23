<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|string',
            'user_id' => 'required|numeric',
            'kelas_id' => 'required|numeric',
            'nisn' => 'required|digits:10|numeric',
            'gender' => [Rule::enum(['L', 'P']), 'required'],
            'dob' => 'required|date',
        ];
    }
}
