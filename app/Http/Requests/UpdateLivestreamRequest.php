<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLivestreamRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],

            'platform' => [
                'required',
                'in:YouTube,Facebook,Zoom,Other',
            ],

            'stream_url' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (blank($value)) {
                        return;
                    }

                    if (!preg_match(
                        '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/|facebook\.com\/video\.php\?v=|zoom\.us\/join\/)/',
                        $value
                    )) {
                        $fail('Please enter a valid YouTube, Facebook, or Zoom URL.');
                    }
                },
            ],

            'scheduled_at' => ['required', 'date'],

            'status' => ['required', 'in:scheduled,live,ended'],

            'description' => ['nullable', 'string'],

            'recording_media_item_id' => [
                'nullable',
                'exists:media_items,id',
            ],

            'is_published' => ['boolean'],
        ];
    }
}
