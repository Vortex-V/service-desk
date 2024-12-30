<?php

declare(strict_types=1);

namespace App\Http\Requests\Ticket;

use App\Models\Ticket\TicketPriority;
use App\Models\Ticket\TicketType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreTicketRequest extends FormRequest
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
     * @return array<string, array>
     */
    public function rules(): array
    {
        return [
            'description' => ['required', 'string'],
            'type_id' => ['required', 'integer', Rule::exists(TicketType::class, 'id')],
            'priority_id' => ['required', 'integer', Rule::exists(TicketPriority::class, 'id')],
        ];
    }
}
