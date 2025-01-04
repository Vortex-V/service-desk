<?php

namespace App\View\Components\ModelView;

use App\View\Components\ModelView\Columns\Column;
use App\View\Components\ModelView\Columns\DataColumn;
use Arr;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

abstract class BaseModelView extends Component
{
    public function __construct(
        public CursorPaginator|Collection|Model $data,
        public array                            $settings,
        public ?string                          $columnClass = DataColumn::class,
    )
    {
    }

    abstract public function render(): View;

    /**
     * @throws ReflectionException
     */
    public function createColumn(array $setting, array|Model|null $data): Column
    {
        $class = $setting['class'] ?? $this->columnClass;
        $reflect = new ReflectionClass($class);
        $attributes = array_map(fn(ReflectionProperty $prop)=>$prop->getName(), $reflect->getProperties(ReflectionProperty::IS_PUBLIC));
        $settings = Arr::only($setting, $attributes);
        return app($class, array_merge($settings, [
            'data' => $data,
        ]));
    }
}
