<?php

namespace App\Http\Requests\Admin\User;

use App\Models\Client\Client;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'],
            'client_id' => [
                'exclude_unless:role,' . UserRole::Client->value,
                'required',
                'integer',
                Rule::exists(Client::class, 'id')],
        ];
    }
}
