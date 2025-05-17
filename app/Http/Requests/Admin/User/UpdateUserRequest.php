<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\User;

use App\Models\Client\Client;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'email' => [
                Rule::excludeIf(fn() => $user->email === $this->get('email')),
                'required', 'email', Rule::unique(User::class, 'email')],
            'password' => [
                Rule::excludeIf(fn() => !$this->get('password')),
                'string',
                'min:8'
            ],
            'role' => [
                Rule::excludeIf(fn() => $user->role->value === $this->get('role')),
                'required',
                'string'
            ],
            'client_id' => [
                'exclude_unless:role,' . UserRole::Client->value,
                Rule::excludeIf(fn() => $user->client_id === (int)$this->get('client_id')),
                'required',
                'integer',
                Rule::exists(Client::class, 'id')],
        ];
    }
}
