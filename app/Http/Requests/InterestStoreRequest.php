<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InterestStoreRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => 'required|string|max:15',
            'city' => 'required|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',

            'university_main_id' => 'required|exists:universities,id',
            'university_second_id' => 'nullable|exists:universities,id',
            'faculty_main_id' => 'required|exists:faculties,id',
            'faculty_second_id' => 'nullable|exists:faculties,id',
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
            'name' => 'Nama',
            'gender' => 'Jenis Kelamin',
            'phone' => 'Nomor Telepon',
            'city' => 'Kota',
            'asal_sekolah' => 'Asal Sekolah',

            'university_main_id' => 'Universitas Pilihan',
            'university_second_id' => 'Universitas Cadangan',
            'faculty_main_id' => 'Fakultas Pilihan',
            'faculty_second_id' => 'Fakultas Cadangan',
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
            'string' => ':attribute harus berupa string',
            'max' => ':attribute tidak boleh lebih dari :max karakter',
            'unique' => ':attribute sudah terdaftar',
            'in' => ':attribute tidak valid',
            'exists' => ':attribute tidak ditemukan',
        ];
    }
}
