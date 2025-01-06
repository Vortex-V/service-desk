<?php

declare(strict_types=1);

namespace App\View\Components\ModelView;

use App\View\Components\ModelView\Columns\DataColumn;
use Generator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

final class Attributes extends Component
{
    public const string COLUMN_VIEW_HORIZONTAL = 'horizontal';
    public const string COLUMN_VIEW_VERTICAL = 'vertical';

    public function __construct(
        public Model   $data,
        public array   $settings,
        public string  $columnView = self::COLUMN_VIEW_HORIZONTAL
    )
    {
    }

    public function render(): View
    {
        return view('components.model-view.list.view');
    }

    public function columnViewName(): string
    {
        return "model-view.list.item.$this->columnView";
    }

    public function columns(): Generator
    {
        foreach ($this->settings as $setting) {
            $class = $setting['class'] ?? DataColumn::class;
            unset($setting['class']);
            yield app($class, array_merge($setting, [
                'data' => $this->data,
            ]));;
        }
    }
}
