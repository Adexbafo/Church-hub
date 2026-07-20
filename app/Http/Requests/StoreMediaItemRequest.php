<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediaItemRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'media_category_id' => [
                'required',
                'exists:media_categories,id',
            ],

            'media_album_id' => [
                'nullable',
                'exists:media_albums,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'file' => [
                'required',
                'file',
                'max:51200', // 50MB
                'mimes:jpg,jpeg,png,gif,webp,pdf,mp3,wav,mp4,mov,avi,doc,docx,ppt,pptx,xls,xlsx',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'media_category_id.required' => 'Please select a media category.',
            'media_category_id.exists' => 'The selected category is invalid.',

            'media_album_id.exists' => 'The selected album is invalid.',

            'title.required' => 'A title is required.',

            'file.required' => 'Please choose a file to upload.',
            'file.file' => 'The uploaded item must be a valid file.',
            'file.max' => 'The file may not be larger than 50MB.',
        ];
    }
}
