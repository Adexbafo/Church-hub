<?php

namespace App\Http\Requests\Donations;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
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

            'user_id' => [
                'nullable',
                'exists:users,id',
            ],

            'donor_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'fund_category_id' => [
                'required',
                'exists:fund_categories,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'required',
                'string',
            ],

            'reference' => [
                'nullable',
                'string',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'donation_date' => [
                'required',
                'date',
            ],

        ];
    }
}
