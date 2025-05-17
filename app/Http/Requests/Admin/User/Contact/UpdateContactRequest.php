<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\User\Contact;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateContactRequest extends FormRequest
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
        $contact = $this->route('contact');
        return [
            'first_name' => [
                Rule::excludeIf(fn() => $contact->first_name === $this->get('first_name')),
                'required', 'string'],
            'last_name' => [
                Rule::excludeIf(fn() => $contact->last_name === $this->get('last_name')),
                'required', 'string'],
            'patronymic' => [
                Rule::excludeIf(fn() => $contact->patronymic === $this->get('patronymic')),
                'string'],
            'phone' => [
                Rule::excludeIf(fn() => $contact->phone === $this->get('phone')),
                'required', 'string'],
        ];
    }
}
