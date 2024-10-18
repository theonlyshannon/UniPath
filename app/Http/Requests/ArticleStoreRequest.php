<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'writer_id' => 'required|exists:writers,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,'.$this->route('article'),
            'content' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:article_categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:article_tags,id',
            'thumbnail' => request()->isMethod('post') ? 'required|image|mimes:jpg,jpeg,png' : 'nullable|image|mimes:jpg,jpeg,png',
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
            'title' => 'Judul Artikel',
            'slug' => 'Slug',
            'content' => 'Konten',
            'categories' => 'Kategori',
            'tags' => 'Tag',
            'thumbnail' => 'Thumbnail',
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
            'array' => ':attribute harus berupa array',
            'exists' => ':attribute tidak valid',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar dengan format: :values',
        ];
    }
}
