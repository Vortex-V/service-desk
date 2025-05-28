<?php

declare(strict_types=1);

namespace App\Models\Client;

use App\Interface\ModelSearch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class ClientSearch implements ModelSearch {
    public function __construct(
        public Request $request,
        public Builder $builder,
    )
    {
        if (!$this->builder?->getModel()) {
            $this->builder = Client::query();
        }
    }

    public function search(): LengthAwarePaginator
    {
        $this->builder
            ->with([
                'legal',
            ])
            ->orderByDesc('id');

        $this->request->whenFilled('id', function (int $value) {
            $this->builder->where('id', $value);
        });

        $this->request->whenFilled('name', function (string $value) {
            $this->builder->where('name', $value);
        });

        return $this->builder
            ->paginate(10)
            ->withQueryString();
    }
}
