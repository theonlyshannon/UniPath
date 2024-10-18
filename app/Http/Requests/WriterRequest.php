<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WriterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => request()->isMethod('post') ? 'required|email|unique:users,email' : ['nullable', 'email', Rule::unique('users', 'email')->ignore(request()->route('writer'))],
            'password' => request()->isMethod('post') ? 'required|string' : 'nullable|string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'email' => ':attribute harus berupa email',
            'unique' => ':attribute sudah terdaftar',
            'string' => ':attribute harus berupa string',
            'mimes' => ':attribute harus berupa gambar dengan format: :values',
            'max' => ':attribute tidak boleh lebih dari :max KB',
        ];
    }
}
