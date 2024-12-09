<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\SupplierUpdateRequest;

class SupplierStoreRequest extends FormRequest
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
        $updateRules = (new SupplierUpdateRequest())->rules();
        return array_merge($updateRules, [
            'id' => ['required', 'numeric', 'digits:8'],
        ]);
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        $updateMessages = (new SupplierUpdateRequest())->messages();
        return array_merge($updateMessages, [
            'id.required' => 'The supplier ID is required.',
            'id.numeric' => 'The supplier ID must be a number.',
            'id.digits' => 'The supplier ID must be exactly 8 digits.',
        ]);
    }
}
