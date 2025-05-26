<?php

namespace App\Service;

use App\View\Components\ModelView\Columns\DataColumn;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelExportService
{
    public function __construct(
        public Model|Collection $data,
        public array            $settings,
    )
    {
    }

    private function getColumns(Model $data = null): array
    {
        $columns = [];
        foreach ($this->settings as $setting) {
            $columns[] = app(DataColumn::class, array_merge($setting, [
                'data' => $data ?? $this->data,
            ]));
        }

        return $columns;
    }

    private function getLabels(): array
    {
        $labels = [];
        foreach ($this->settings as $setting) {
            if (!empty($setting['label'])) {
                $labels[] = $setting['label'];
            } else {
                $label = Str::of($setting['attribute'])->snake()->explode('_')->join('_');
                $labels[] = Str::apa($label);
            }
        }

        return $labels;
    }

    public function export(): Xlsx
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(array_map(static fn(DataColumn $column)=>[
            $column->getLabel(),
            $column->getValue()
        ], $this->getColumns()));

        foreach (range('A', 'Z') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return new Xlsx($spreadsheet);
    }

    public function exportCollection(): Xlsx
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray($this->getLabels());

        $rowIndex = 2;
        foreach ($this->data as $data) {
            $sheet->fromArray(
                array_reduce($this->getColumns($data),
                    static function(array $carry, DataColumn $column) {
                        $carry[] = $column->getValue();
                        return $carry;
                    },
                    []),
                startCell: "A$rowIndex"
            );
            $rowIndex++;
        }

        foreach (range('A', 'Z') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return new Xlsx($spreadsheet);
    }
}
