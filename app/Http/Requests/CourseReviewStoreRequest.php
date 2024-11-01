<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseReviewStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
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
            'review' => 'Review',
            'rating' => 'Rating',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute harus berupa teks',
            'max' => ':attribute tidak boleh lebih dari :max karakter',
            'integer' => ':attribute harus berupa angka',
            'min' => ':attribute harus minimal :min',
            'max' => ':attribute tidak boleh lebih dari :max',
        ];
    }
}
