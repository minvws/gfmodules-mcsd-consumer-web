<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO Implement authorization logic
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'endpoint' => ['required', 'url:http,https'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The supplier name is required.',
            'name.string' => 'The supplier name must be a string.',
            'endpoint.required' => 'The supplier endpoint is required.',
            'endpoint.url' => 'The supplier endpoint must be a valid URL.',
        ];
    }
}
