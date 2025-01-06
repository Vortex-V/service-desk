<?php

declare(strict_types=1);

namespace App\View\Components\ModelView;

use App\View\Components\ModelView\Columns\ActionColumn;
use App\View\Components\ModelView\Columns\Column;
use App\View\Components\ModelView\Columns\DataColumn;
use Generator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

final class Table extends Component
{

    /** @var Column[]  */
    private array $columns = [];

    public function __construct(
        public LengthAwarePaginator|Collection|Model $data,
        public array                            $settings,
    )
    {
    }

    public function render(): View
    {
        return view('components.model-view.grid.view');
    }

    public function labels(): Generator
    {
        foreach ($this->settings as $setting) {
            if ($setting['class'] ?? '' === ActionColumn::class) {
                continue;
            }

            if (!empty($setting['label'])) {
                yield $setting['label'];
            } else {
                $label = Str::of($setting['attribute'])->snake()->explode('_')->join('_');
                yield Str::apa($label);
            }
        }
    }

    public function models(): Generator
    {
        foreach ($this->data as $model) {
            yield $model;
        }
    }

    public function columns(array|Model $data): Generator
    {
        foreach ($this->settings as $setting) {
            $class = $setting['class'] ?? DataColumn::class;
            unset($setting['class']);
            yield app($class, array_merge($setting, [
                'data' => $data,
            ]));
        }
    }
}
