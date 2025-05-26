<?php

declare(strict_types=1);

namespace App\Models\User;

use App\Interface\ModelSearch;
use App\Models\User\Enum\UserRole;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

final class UserSearch implements ModelSearch {
    public function __construct(
        public Request $request,
        public Builder $builder,
    )
    {
        if (!$this->builder?->getModel()) {
            $this->builder = User::query();
        }
    }

    public function load(): self
    {
        $this->builder
            ->with([
                'contact', 'client'
            ])
            ->orderByDesc('id');

        $this->request->whenFilled('id', function (int $value) {
            $this->builder->where('id', $value);
        });

        $this->request->whenFilled('email', function (string $value) {
            $this->builder->where('email', $value);
        });

        $this->request->whenFilled('role', function (string $value) {
            $this->builder->where('role', $value);
        });

        $this->request->whenFilled('client_id', function (int $value) {
            $this->builder->where('client_id', $value);
        });

        return $this;
    }

    public function search(): LengthAwarePaginator
    {
        return $this->builder
            ->paginate(10)
            ->withQueryString();
    }

    public function collection(): Collection
    {
        return $this->builder->get();
    }

    public function withoutAdmin(): self
    {
        $this->builder->whereNot('role', UserRole::Admin);
        return $this;
    }
}
