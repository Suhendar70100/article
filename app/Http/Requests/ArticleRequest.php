<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title movie harus diisi.',
            'title.max' => 'Jumlah karakter title maksimal 255.',
            'content.required' => 'Konten Artikel harus diisi.',
            'image.mimes' => 'Format image harus jpg, bmp, png.',
        ];
    }
}