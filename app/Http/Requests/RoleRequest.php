<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => request()->route('role') ? 'required|string|max:255' : 'required|string|max:255|unique:roles',
            'guard_name' => 'required|string|max:255',
            'permission' => 'required|array',
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
            'name' => 'Nama Role',
            'guard_name' => 'Guard Name',
            'permission' => 'Permission',
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
            'string' => ':attribute harus berupa string',
            'max' => ':attribute tidak boleh melebihi :max karakter',
            'array' => ':attribute harus berupa array',
        ];
    }
}
