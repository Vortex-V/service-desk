<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Components\ModelView\BaseModelView;
use App\View\Components\ModelView\Columns\ActionColumn;
use App\View\Components\ModelView\Columns\Column;
use App\View\Components\ModelView\Columns\DataColumn;
use Generator;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionException;

final class GridView extends BaseModelView
{

    /** @var Column[]  */
    private array $columns = [];

    public function __construct(CursorPaginator|Model|Collection $data, array $settings, ?string $columnClass = DataColumn::class)
    {
        parent::__construct($data, $settings, $columnClass);
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

    /**
     * @throws ReflectionException
     */
    public function columns(array|Model $data): Generator
    {
        foreach ($this->settings as $setting) {
            yield $this->createColumn($setting, $data);
        }
    }
}
