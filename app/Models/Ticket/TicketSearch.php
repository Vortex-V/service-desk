<?php

declare(strict_types=1);

namespace App\Models\Ticket;

use App\Interface\ModelSearch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class TicketSearch implements ModelSearch {
    public function __construct(
        public Request $request,
        public Builder $builder,
    )
    {
        if (!$this->builder?->getModel()) {
            $this->builder = Ticket::query();
        }
    }


    public function search(): LengthAwarePaginator
    {
        $this->builder
            ->with([
                'applicant', 'applicant.contact', 'manager', 'manager.contact', 'client', 'type', 'priority'
            ])
            ->orderByDesc('id');

        $this->request->whenFilled('id', function (int $value) {
            $this->builder->where('id', $value);
        });

        $this->request->whenFilled('type_id', function (int $value) {
            $this->builder->where('type_id', $value);
        });

        $this->request->whenFilled('priority_id', function (int $value) {
            $this->builder->where('priority_id', $value);
        });

        $this->request->whenFilled('status', function (string $value) {
            $this->builder->where('status', $value);
        });

        $this->request->whenFilled('client_id', function (int $value) {
            $this->builder->where('client_id', $value);
        });

        return $this->builder
            ->paginate(10)
            ->withQueryString();
    }

    public function whereClientId(int $clientId): self
    {
        $this->builder->where('client_id', $clientId);
        return $this;
    }

    public function whereManagerId(int $userId): self
    {
        $ticketT = 'tickets';
        $this->builder->where(function (Builder $query) use ($ticketT, $userId) {
            $query
                ->whereAny(["$ticketT.author_id", "$ticketT.manager_id"], $userId)
                ->orWhereRelation('client.services.users', 'id', $userId);
        })
        ;
        return $this;
    }
}
