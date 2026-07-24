<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
            ],

            'category' => [
                'required',
                'string',
                'max:255',
            ],

            'audience' => [
                'required',
                'in:all,member,admin',
            ],

            'priority' => [
                'required',
                'in:low,normal,high,urgent',
            ],

            'link' => [
                'nullable',
                'url',
                'max:255',
            ],

            'expires_at' => [
                'nullable',
                'date',
                'after:now',
            ],

            'is_pinned' => [
                'nullable',
                'boolean',
            ],

            'attachment' => [
                'nullable',
                'file',
                'max:2048',
            ],

        ];
    }
}
