<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseSubjectStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_subjects.*.subject_file' => 'required|file|mimes:pdf,docx,txt|max:2048',
            'course_subjects.*.subject_video' => 'required|string|url|max:255',
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
            'course_subjects.*.subject_file' => 'File Materi',
            'course_subjects.*.subject_video' => 'Link Video',
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
            'min' => ':attribute tidak boleh kurang dari :min',
            'max' => ':attribute tidak boleh lebih dari :max karakter',
            'mimes' => ':attribute harus berupa file dengan format: :values',
            'file' => ':attribute harus berupa file yang valid',
            'url' => ':attribute harus berupa URL yang valid',
        ];
    }
}
