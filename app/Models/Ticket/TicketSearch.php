<?php

namespace App\Models\Ticket;

use App\Interface\ModelSearch;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TicketSearch implements ModelSearch {
    public function __construct(
        public Request $request,
        public Builder $builder,
    )
    {
    }


    public function search(): CursorPaginator
    {
        $ticketT = 'tickets';
        $userT = 'users';

        $user = auth()->user();

        if (!$this->builder?->getModel()) {
            $this->builder = Ticket::query();
        }

        $this->builder
            ->with([
                'applicant', 'applicant.contact', 'manager', 'manager.contact', 'client', 'type', 'priority'
            ])
            ->where(function (Builder $query) use ($ticketT, $user) {
                $query
                    ->whereAny(["$ticketT.author_id", "$ticketT.applicant_id"], $user->id)
                    ->orWhereRelation('client.services.users', 'id', $user->id)
                ;
            })
        ;

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

        return $this->builder->cursorPaginate(10);
    }
}
