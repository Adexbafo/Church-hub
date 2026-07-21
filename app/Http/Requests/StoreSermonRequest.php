<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSermonRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],

            'speaker' => ['required', 'string', 'max:255'],

            'scripture' => ['nullable', 'string', 'max:255'],

            'sermon_date' => ['required', 'date'],

            'description' => ['nullable', 'string'],

            'audio_media_item_id' => [
                'nullable',
                'exists:media_items,id',
                'required_without_all:video_media_item_id,notes_media_item_id',
            ],

            'video_media_item_id' => [
                'nullable',
                'exists:media_items,id',
                'required_without_all:audio_media_item_id,notes_media_item_id',
            ],

            'notes_media_item_id' => [
                'nullable',
                'exists:media_items,id',
                'required_without_all:audio_media_item_id,video_media_item_id',
            ],

            'is_featured' => ['boolean'],

            'is_published' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'audio_media_item_id.required_without_all' =>
            'Please select at least one media resource (Audio, Video, or Notes).',

            'video_media_item_id.required_without_all' =>
            'Please select at least one media resource (Audio, Video, or Notes).',

            'notes_media_item_id.required_without_all' =>
            'Please select at least one media resource (Audio, Video, or Notes).',
        ];
    }
}
