<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'email' => 'Email',
            'password' => 'Password',
            'gender' => 'Jenis Kelamin',
            'phone' => 'No. Handphone',
            'city' => 'Kota',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'email' => ':attribute harus berupa email',
            'unique' => ':attribute sudah terdaftar',
            'string' => ':attribute harus berupa string',
        ];
    }
}
