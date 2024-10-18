<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MentorStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'gender' => 'required|string',
            'phone' => ['required', 'string', 'regex:/^62[0-9]{9,12}$/'],
            'city' => 'required|string',
            'specialization' => 'required|string',
            'bio' => 'required|string',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'profile_picture' => 'Foto Profil',
            'name' => 'Nama Lengkap',
            'email' => 'Email',
            'password' => 'Password',
            'specialization' => 'Specialisasi',
            'gender' => 'Jenis Kelamin',
            'phone' => 'No. Handphone',
            'city' => 'Kota',
            'bio' => 'Bio',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'email' => ':attribute harus berupa email',
            'unique' => ':attribute sudah terdaftar',
            'string' => ':attribute harus berupa string',
            'regex' => ':attribute tidak valid (contoh: 6281234567890)',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar dengan format: :values',
            'max' => ':attribute tidak boleh lebih dari :max KB',
        ];
    }
}
